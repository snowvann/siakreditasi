<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Isian;
use App\Models\ValidasiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:SuperAdmin|Validator|Anggota']);
    }

    public function show($id)
    {
        $kriteria = Kriteria::with('subkriteria')->findOrFail($id);

        // Fetch members associated with the criteria (replace with actual logic)
        $anggotaKriteria = [
            ['id' => 1, 'name' => 'Dr. Budi Santoso, M.Pd.'],
            ['id' => 2, 'name' => 'Dr. Siti Rahayu, M.Si.']
        ];

        // Fetch all validators
        $validatorList = User::whereNotNull('level_validator')
            ->orderBy('level_validator')
            ->get();

        // Fetch the latest validation logs for this criteria
        $logs = ValidasiLog::where('kriteria_id', $id)
            ->with('user')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('user_id');

        $allValidasiDisplay = [];
        foreach ($validatorList as $validator) {
            $userId = $validator->id;
            $latestLog = $logs->has($userId) ? $logs[$userId]->first() : null;

            $allValidasiDisplay[] = [
                'user' => $validator,
                'status' => $latestLog->status ?? 'belum validasi',
                'komentar' => $latestLog->komentar ?? '-',
                'waktu' => $latestLog->created_at ?? null,
            ];
        }

        // Calculate progress for each sub-criteria
        $subKriteriaWithProgress = $kriteria->subkriteria->map(function ($subKriteria) {
            $hasIsian = Isian::where('subkriteria_id', $subKriteria->id)
                ->where('akreditasi_id', 1)
                ->whereNotNull('nilai')
                ->exists();

            $subKriteria->has_isian = $hasIsian;
            return $subKriteria;
        });

        // Calculate total progress
        $totalSubkriteria = $kriteria->subkriteria->count();
        $completedSubkriteria = $subKriteriaWithProgress->where('has_isian', true)->count();
        $progressPercentage = $totalSubkriteria > 0 ? round(($completedSubkriteria / $totalSubkriteria) * 100) : 0;

        return view('kriteria.show', [
            'kriteriaId' => $kriteria->id,
            'kriteriaData' => $kriteria,
            'anggotaKriteria' => $anggotaKriteria,
            'subKriteriaList' => $subKriteriaWithProgress,
            'validasis' => $allValidasiDisplay,
            'progressPercentage' => $progressPercentage,
            'totalSubkriteria' => $totalSubkriteria,
            'completedSubkriteria' => $completedSubkriteria
        ]);
    }

    public function showSubKriteria($kriteriaId, $subKriteriaId)
    {
        $subKriteria = SubKriteria::where('id', $subKriteriaId)
            ->where('kriteria_id', $kriteriaId)
            ->firstOrFail();

        $akreditasiIsi = Isian::where('subkriteria_id', $subKriteriaId)
            ->where('akreditasi_id', 1)
            ->value('nilai');

        $validationLogs = $this->getValidationLogs($kriteriaId, $subKriteriaId);

        return view('kriteria.subkriteria.show', compact(
            'kriteriaId', 'subKriteriaId', 'subKriteria', 'akreditasiIsi', 'validationLogs'
        ));
    }

    public function simpanIsian(Request $request, $kriteriaId, $subKriteriaId)
    {
        $sub = SubKriteria::where('id', $subKriteriaId)
            ->where('kriteria_id', $kriteriaId)
            ->first();

        if (!$sub) {
            return response()->json(['error' => 'Subkriteria tidak valid.'], 400);
        }

        $akreditasiId = $request->input('akreditasi_id') ?? 1;
        $action = $request->input('action');

        // Handle AJAX file upload for images
        if ($request->ajax() && $request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:5120',
            ]);

            $file = $request->file('file');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads', $filename);
            $url = asset(Storage::url($path));

            return response()->json(['url' => $url]);
        }

        // Reset action
        if ($action === 'reset') {
            Isian::where('subkriteria_id', $subKriteriaId)
                ->where('akreditasi_id', $akreditasiId)
                ->delete();

            return redirect()->back()->with('status', 'Data berhasil di-reset.');
        }

        $request->validate([
            'nilai' => 'required|string',
        ]);

        // Save or update the isian
        Isian::updateOrCreate(
            ['subkriteria_id' => $subKriteriaId, 'akreditasi_id' => $akreditasiId],
            ['nilai' => $request->input('nilai')]
        );

        $pesan = $action === 'submit' ? 'Data berhasil disubmit.' : 'Data berhasil disimpan.';
        return redirect()->back()->with('status', $pesan);
    }

    private function getValidationLogs($kriteriaId, $subKriteriaId)
    {
        // Fetch actual validation logs from the database
        return ValidasiLog::where('kriteria_id', $kriteriaId)
            ->where('subkriteria_id', $subKriteriaId)
            ->with('user')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'peran_validator' => $log->user->role ?? 'Unknown',
                    'status_sebelum' => $log->status_sebelum ?? 'menunggu_validasi',
                    'status_sesudah' => $log->status_sesudah ?? 'belum validasi',
                    'komentar' => $log->komentar ?? '-',
                    'created_at' => $log->created_at->format('d M Y'),
                ];
            })->toArray();
    }

    public function unduhPdf($kriteriaId)
    {
        try {
            $kriteria = Kriteria::with(['subkriteria' => function ($query) {
                $query->with(['isian' => function ($q) {
                    $q->where('akreditasi_id', 1);
                }]);
            }])->findOrFail($kriteriaId);

            $data = ['kriteria' => $kriteria];

            $html = view('pdf.kriteria', $data)->render();
            $html = $this->convertImagesToBase64($html);

            $pdf = Pdf::loadHTML($html)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'dpi' => 150,
                    'defaultFont' => 'Arial',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                ]);

            $filename = 'Kriteria_' . $kriteria->id . '_' . date('Y-m-d_H-i-s') . '.pdf';
            $path = 'public/pdf/' . $filename;
            Storage::put($path, $pdf->output());

            // Optionally save the path to the database
            $kriteria->pdf_path = Storage::url($path);
            $kriteria->save();

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menggenerate PDF: ' . $e->getMessage());
        }
    }

    private function convertImagesToBase64($html)
    {
        return preg_replace_callback('/<img[^>]+src="([^">]+)"/i', function ($matches) {
            $src = $matches[1];

            if (str_starts_with($src, 'data:image')) {
                return $matches[0];
            }

            $fullPath = null;

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
                Log::warning("Image file not found for PDF: " . ($fullPath ?? $src));
            }

            return $matches[0];
        }, $html);
    }

    public function index()
    {
        $kriteriaList = Kriteria::with('subkriteria')->get();
        return view('admin.kriteria.manage', compact('kriteriaList'));
    }

    // Tambahkan di KriteriaController.php
    public function manage()
    {
        $kriteriaList = Kriteria::with('subkriteria')->get();
        return view('superadmin.kriteria.manage', compact('kriteriaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persentase' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $kriteria = Kriteria::create([
                'nama_kriteria' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'persentase' => $request->persentase,
                'status' => 'active'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kriteria berhasil ditambahkan',
                'data' => $kriteria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $kriteria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kriteria tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persentase' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->update([
                'nama_kriteria' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'persentase' => $request->persentase
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kriteria berhasil diperbarui',
                'data' => $kriteria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kriteria berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kriteria: ' . $e->getMessage()
            ], 500);
        }
    }
}