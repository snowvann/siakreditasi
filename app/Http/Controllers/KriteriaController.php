<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Isian;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KriteriaController extends Controller
{

    
    public function show($id)
    {
        $kriteria = Kriteria::with('subkriteria')->findOrFail($id);
    
        // Ambil anggota dari tabel users (misal yang memiliki role tertentu atau semua)
        $anggotaKriteria = User::pluck('name')->toArray();
    
        // Ambil waktu terakhir update dari tabel t_isian untuk kriteria ini
        $latestUpdate = DB::table('t_isian')
            ->join('sub_kriteria', 't_isian.subkriteria_id', '=', 'sub_kriteria.id')
            ->where('sub_kriteria.kriteria_id', $id)
            ->max('t_isian.updated_at');
    
        // Hitung jumlah subkriteria yang terisi (nilai tidak null)
        $totalSub = $kriteria->subkriteria->count();
        $filledSub = Isian::whereIn('subkriteria_id', $kriteria->subkriteria->pluck('id'))
                          ->whereNotNull('nilai')
                          ->distinct('subkriteria_id')
                          ->count('subkriteria_id');
    
        $progress = $totalSub > 0 ? round(($filledSub / $totalSub) * 100) : 0;
    
        return view('kriteria.show', [
            'kriteriaId' => $kriteria->id,
            'kriteriaData' => $kriteria,
            'anggotaKriteria' => $anggotaKriteria,
            'updatedAt' => $latestUpdate,
            'progress' => $progress,
            'subKriteriaList' => $kriteria->subkriteria
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
            // Load kriteria dengan relasi yang benar
            $kriteria = Kriteria::with(['subkriteria' => function($query) {
                $query->with(['isian' => function($q) {
                    $q->where('akreditasi_id', 1);
                }]);
            }])->findOrFail($kriteriaId);

            $data = [
                'kriteria' => $kriteria,
            ];

            // Generate HTML view
            $html = view('pdf.kriteria', $data)->render();

            // Convert images to base64 for PDF compatibility
            $html = $this->convertImagesToBase64($html);

            // Generate PDF
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
    }

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
                // Format: http://domain.com/storage/uploads/filename.jpg
                $filename = basename($src);
                $fullPath = storage_path('app/public/uploads/' . $filename);
            } elseif (str_starts_with($src, '/storage/')) {
                // Format: /storage/uploads/filename.jpg
                $relativePath = str_replace('/storage/', '', $src);
                $fullPath = storage_path('app/public/' . $relativePath);
            } elseif (str_starts_with($src, asset('storage'))) {
                // Handle asset URLs
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
                Log::warning("Image file not found for PDF: " . ($fullPath ?? $src));
            }

            return $matches[0];
        }, $html);
    }
}