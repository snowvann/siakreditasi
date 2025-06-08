<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\ValidasiKriteria; 
use App\Models\KomentarValidasi;
use App\Models\ValidasiLog;
use App\Models\Notifikasi;



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

    
        // Method untuk menampilkan halaman kriteria validator
        public function show($id)
        {
            $user = auth()->user();
            $kriteria = Kriteria::findOrFail($id);
    
            // Cek jika user bukan level 1, maka harus pastikan level sebelumnya sudah "valid"
            if ($user->level_validator > 1) {
                $previousLevel = $user->level_validator - 1;
    
                // Ambil log validasi dari level sebelumnya
                $previousLog = ValidasiLog::where('kriteria_id', $id)
                    ->where('level_validator', $previousLevel)
                    ->latest('created_at')
                    ->first();
    
                // Kalau belum ada validasi sebelumnya atau statusnya bukan "valid", blokir akses
                if (!$previousLog || $previousLog->status !== 'valid') {
                    return view('validator.blokir', [
                        'kriteria' => $kriteria,
                        'previousLevel' => $previousLevel,
                        'currentLevel' => $user->level_validator
                    ]);
                }
            }
    
            // Jika lolos pengecekan, tampilkan halaman validasi normal
            $pdfUrl = $kriteria->file_path ?? null;
            
            return view('validator\kriteria-validation', [
                'kriteria' => $kriteria,
                'pdfUrl' => $pdfUrl
            ]);
        }
        // Method validasiStore yang sudah diupdate untuk many-to-many
        public function validasiStore(Request $request, $id)
        {
            $user = auth()->user();

            // Validasi input dari form
            $request->validate([
                'aksi' => 'required|in:valid,revisi',
                'komentar' => 'nullable|string|max:1000',
            ]);

            // Cek jika user bukan level 1, maka harus pastikan level sebelumnya sudah "valid"
            if ($user->level_validator > 1) {
                $previousLevel = $user->level_validator - 1;

                // Ambil log validasi dari level sebelumnya
                $previousLog = ValidasiLog::where('kriteria_id', $id)
                    ->where('level_validator', $previousLevel)
                    ->latest('created_at')
                    ->first();

                // Kalau belum ada validasi sebelumnya atau statusnya bukan "valid", blokir akses
                if (!$previousLog || $previousLog->status !== 'valid') {
                    return view('validator.blokir', [
                        'kriteria' => Kriteria::findOrFail($id),
                        'previousLevel' => $previousLevel,
                        'currentLevel' => $user->level_validator
                    ]);
                }
            }

            $kriteria = Kriteria::with('users')->findOrFail($id);

            // Simpan log validasi baru
            $validasiLog = ValidasiLog::create([
                'kriteria_id' => $id,
                'user_id' => $user->id,
                'level_validator' => $user->level_validator,
                'status' => $request->aksi === 'valid' ? 'valid' : 'tidak valid',
                'komentar' => $request->komentar,
            ]);

            // Ambil status terakhir dan simpan ke tabel validasi_kriteria
            $lastStatus = ValidasiLog::where('kriteria_id', $id)
                ->latest('created_at')
                ->value('status');

            $validasiKriteria = ValidasiKriteria::where('kriteria_id', $id)->firstOrFail();
            $validasiKriteria->status = $lastStatus;
            $validasiKriteria->save();

            // Simpan komentar (jika ada)
            if ($request->komentar) {
                KomentarValidasi::create([
                    'validasi_kriteria_id' => $validasiKriteria->id,
                    'user_id' => $user->id,
                    'komentar' => $request->komentar,
                ]);
            }

            // OPSI 1: Kirim notifikasi ke semua user yang terkait dengan kriteria
            $this->sendNotificationToAllUsers($kriteria, $user, $validasiLog, $request->aksi);

            // OPSI 2: Kirim notifikasi hanya ke user pertama (jika ingin tunggal)
            // $this->sendNotificationToFirstUser($kriteria, $user, $validasiLog, $request->aksi);

            return redirect()->back()->with('success', 'Validasi berhasil disimpan.');
        }

        /**
         * Kirim notifikasi ke semua user yang terkait dengan kriteria
         */
        private function sendNotificationToAllUsers($kriteria, $validator, $validasiLog, $aksi)
        {
            if ($kriteria->users->isEmpty()) {
                Log::warning("Tidak ada user yang terkait dengan kriteria ID: {$kriteria->id}");
                return;
            }

            $judul = $aksi === 'valid' ? 'Kriteria telah divalidasi' : 'Kriteria perlu direvisi';
            $pesan = "Kriteria '{$kriteria->nama}' divalidasi oleh {$validator->name} dengan status: {$validasiLog->status}";

            foreach ($kriteria->users as $user) {
                try {
                    Notifikasi::create([
                        'user_id' => $user->id,
                        'judul' => $judul,
                        'pesan' => $pesan,
                        'dibaca' => false,
                    ]);
                } catch (\Exception $e) {
                    Log::error("Error creating notification for user {$user->id}: " . $e->getMessage());
                }
            }

            Log::info("Notifikasi berhasil dikirim ke " . $kriteria->users->count() . " user untuk kriteria: {$kriteria->nama}");
        }

        /**
         * Kirim notifikasi hanya ke user pertama yang terkait dengan kriteria
         */
        private function sendNotificationToFirstUser($kriteria, $validator, $validasiLog, $aksi)
        {
            $firstUser = $kriteria->users->first();
            
            if (!$firstUser) {
                Log::warning("Tidak ada user yang terkait dengan kriteria ID: {$kriteria->id}");
                return;
            }

            $judul = $aksi === 'valid' ? 'Kriteria telah divalidasi' : 'Kriteria perlu direvisi';
            $pesan = "Kriteria '{$kriteria->nama}' divalidasi oleh {$validator->name} dengan status: {$validasiLog->status}";

            try {
                Notifikasi::create([
                    'user_id' => $firstUser->id,
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'dibaca' => false,
                ]);

                Log::info("Notifikasi berhasil dikirim ke user {$firstUser->name} untuk kriteria: {$kriteria->nama}");
            } catch (\Exception $e) {
                Log::error("Error creating notification for user {$firstUser->id}: " . $e->getMessage());
            }
        }
            
}