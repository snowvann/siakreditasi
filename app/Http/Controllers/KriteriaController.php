<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Isian;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\ValidasiKriteria;
use App\Models\User;
use App\Models\ValidasiLog;


class KriteriaController extends Controller
{
    public function show($id)
    {
        $kriteria = Kriteria::with('subkriteria')->findOrFail($id);
    
        $anggotaKriteria = [
            ['id' => 1, 'name' => 'Dr. Budi Santoso, M.Pd.'],
            ['id' => 2, 'name' => 'Dr. Siti Rahayu, M.Si.']
        ];
    
        // Ambil semua user yang punya level validator
        $validatorList = User::whereNotNull('level_validator')
            ->orderBy('level_validator')
            ->get();
    
        // Ambil validasi terakhir tiap user untuk kriteria ini
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
    
        // Hitung progress untuk setiap subkriteria
        $subKriteriaWithProgress = $kriteria->subkriteria->map(function ($subKriteria) {
            // Cek apakah subkriteria ini sudah memiliki isian
            $hasIsiaan = Isian::where('subkriteria_id', $subKriteria->id)
                              ->where('akreditasi_id', 1) // atau sesuai akreditasi yang aktif
                              ->whereNotNull('nilai')
                              ->exists();
            
            $subKriteria->has_isian = $hasIsiaan;
            return $subKriteria;
        });
    
        // Hitung total progress
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

        $nilai = $request->input('nilai');

        // Save or update the isian
        Isian::updateOrCreate(
            ['subkriteria_id' => $subKriteriaId, 'akreditasi_id' => $akreditasiId],
            ['nilai' => $nilai]
        );

        $pesan = $action === 'submit' ? 'Data berhasil disubmit.' : 'Data berhasil disimpan.';
        return redirect()->back()->with('status', $pesan);
    }

    private function getValidationLogs($kriteriaId, $subKriteriaId)
    {
        if ($kriteriaId <= 2) {
            return [
                [
                    'id' => 1,
                    'peran_validator' => "KPS",
                    'status_sebelum' => "menunggu_validasi",
                    'status_sesudah' => "validated",
                    'komentar' => "Data sudah lengkap dan sesuai dengan standar akreditasi.",
                    'created_at' => "14 Mei 2025",
                ],
                [
                    'id' => 2,
                    'peran_validator' => "Kajur",
                    'status_sebelum' => "menunggu_validasi",
                    'status_sesudah' => "validated",
                    'komentar' => "Disetujui.",
                    'created_at' => "15 Mei 2025",
                ],
            ];
        }

        return [];
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

            $pdf = PDF::loadHTML($html)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'dpi' => 150,
                    'defaultFont' => 'Arial',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                ]);

            $filename = 'Kriteria_' . $kriteria->id . '_' . date('Y-m-d_H-i-s') . '.pdf';
            return $pdf->stream($filename);

        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menggenerate PDF: ' . $e->getMessage());
        }
         // Simpan PDF ke penyimpanan
            Storage::put($path, $pdf->output());

            // Simpan jalur di database
            $kriteria->pdf_path = Storage::url($path);
            $kriteria->save();
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
}
