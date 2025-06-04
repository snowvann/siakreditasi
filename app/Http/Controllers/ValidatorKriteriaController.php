<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ValidatorKriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:validator']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $activeTab = $request->input('tab', 'validation');
        $sortBy = $request->input('sort', 'newest');

        $query = Kriteria::query();

        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kriteria', 'like', '%'.$search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        // Filter by tab
        switch ($activeTab) {
            case 'validation':
                $query->whereIn('status', ['pending', 'menunggu_validasi']);
                break;
            case 'revision':
                $query->whereIn('status', ['needs_revision', 'revisi']);
                break;
            case 'validated':
                $query->where('status', 'validated');
                break;
            case 'all':
            default:
                // Show all
                break;
        }

        // Sorting
        switch ($sortBy) {
            case 'newest':
                $query->latest('created_at');
                break;
            case 'oldest':
                $query->oldest('created_at');
                break;
            case 'priority-high':
                $query->orderBy('priority', 'desc');
                break;
            case 'priority-low':
                $query->orderBy('priority', 'asc');
                break;
        }

        // Get all kriteria for stats
        $allKriteria = Kriteria::all();
        
        // Get filtered results - use get() instead of paginate() for now
        $filteredKriteria = $query->get();

        // Calculate stats
        $pendingValidation = Kriteria::whereIn('status', ['pending', 'menunggu_validasi'])->count();
        $needsRevision = Kriteria::whereIn('status', ['needs_revision', 'revisi'])->count();
        $validated = Kriteria::where('status', 'validated')->count();

        return view('validator.dashboard', compact(
            'filteredKriteria',
            'allKriteria',
            'pendingValidation',
            'needsRevision',
            'validated',
            'activeTab',
            'sortBy',
            'search'
        ));
    }

    public function list()
    {
        $kriteria = Kriteria::paginate(10);
        return view('validator.kriteria.index', compact('kriteria'));
    }

    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('validator.kriteria-validation', compact('kriteria'));
    }

    public function validatekriteria(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,revise',
            'comment' => 'required_if:action,reject,revise|max:1000'
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $user = Auth::user();

        switch ($request->action) {
            case 'approve':
                $kriteria->status = 'validated';
                $message = 'Kriteria berhasil disetujui.';
                break;
            case 'reject':
                $kriteria->status = 'rejected';
                $message = 'Kriteria berhasil ditolak.';
                break;
            case 'revise':
                $kriteria->status = 'revisi'; // Changed to match view expectations
                $message = 'Permintaan revisi berhasil dikirim.';
                break;
        }

        $kriteria->validator_id = $user->id;
        $kriteria->validation_comment = $request->comment;
        $kriteria->validated_at = now();
        $kriteria->save();

        return redirect()
            ->route('validator.dashboard')
            ->with('success', $message);
    }

    public function previewPdf($id)
    {
        try {
            // Load kriteria with the same eager loading as KriteriaController
            $kriteria = Kriteria::with(['subkriteria' => function ($query) {
                $query->with(['isian' => function ($q) {
                    $q->where('akreditasi_id', 1);
                }]);
            }])->findOrFail($id);

            $data = ['kriteria' => $kriteria];

            // Render HTML and convert images to base64
            $html = view('pdf.kriteria', $data)->render();
            $html = $this->convertImagesToBase64($html);

            // Create PDF with same options as KriteriaController
            $pdf = Pdf::loadHTML($html)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'dpi' => 150,
                    'defaultFont' => 'Arial',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                ]);

            return $pdf->stream("kriteria_preview_$id.pdf");

        } catch (\Exception $e) {
            Log::error('Error generating PDF preview: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menggenerate preview PDF: ' . $e->getMessage());
        }
    }

    /**
     * Convert image URLs in HTML to base64 for PDF generation
     * (Copied from KriteriaController)
     */
    private function convertImagesToBase64($html)
    {
        return preg_replace_callback('/<img[^>]+src="([^">]+)"/i', function ($matches) {
            $src = $matches[1];

            // Skip if already base64
            if (str_starts_with($src, 'data:image')) {
                return $matches[0];
            }

            $fullPath = null;

            // Handle different URL formats
            if (str_contains($src, '/storage/uploads/')) {
                $filename = basename($src);
                $fullPath = storage_path('app/public/uploads/' . $filename);
            } elseif (str_starts_with($src, '/storage/')) {
                $relativePath = str_replace('/storage/', '', $src);
                $fullPath = storage_path('app/public/' . $relativePath);
            } elseif (str_starts_with($src, asset('storage'))) {
                $parsedUrl = parse_url($src);
                $path = $parsedUrl['path'] ?? $src;
                $relativePath = str_replace('/storage', 'public', $path);
                $fullPath = storage_path('app/' . $relativePath);
            }

            // Convert to base64 if file exists
            if ($fullPath && File::exists($fullPath)) {
                try {
                    $mime = File::mimeType($fullPath);
                    $data = base64_encode(file_get_contents($fullPath));
                    $base64 = "data:$mime;base64,$data";

                    return str_replace($src, $base64, $matches[0]);
                } catch (\Exception $e) {
                    Log::warning("Error converting image to base64: $fullPath - " . $e->getMessage());
                }
            } else {
                Log::warning("Image file not found for PDF preview: " . ($fullPath ?? $src));
            }

            return $matches[0];
        }, $html);
    }
}