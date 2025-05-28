<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Isian;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;



class KriteriaController extends Controller
{
    public function show($id)
    {
        $kriteria = Kriteria::with('subkriteria')->findOrFail($id);

        // Dummy data anggota (bisa diganti dengan dari database jika perlu)
        $anggotaKriteria = [
            ['id' => 1, 'name' => 'Dr. Budi Santoso, M.Pd.'],
            ['id' => 2, 'name' => 'Dr. Siti Rahayu, M.Si.']
        ];

        return view('kriteria.show', [
            'kriteriaId' => $kriteria->id,
            'kriteriaData' => $kriteria,
            'anggotaKriteria' => $anggotaKriteria,
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

    // Jika AJAX request hanya untuk upload file
    if ($request->ajax() && $request->hasFile('file')) {
        $file = $request->file('file');
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            return response()->json(['error' => 'File tidak didukung.'], 422);
        }

        $filename = \Illuminate\Support\Str::uuid() . '.' . $extension;
        $path = $file->storeAs('public/uploads', $filename);
        $url = asset(Storage::url($path));

        return response()->json(['url' => $url]);
    }

    // Normal proses simpan atau submit
    if ($action === 'reset') {
        Isian::where('subkriteria_id', $subKriteriaId)
              ->where('akreditasi_id', $akreditasiId)
              ->delete();
        return redirect()->back()->with('status', 'Data berhasil di-reset.');
    }

    $nilai = $request->input('nilai');
    $uploadedFileUrl = '';

    if ($request->hasFile('file')) {
        // Upload biasa
        $file = $request->file('file');
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, $allowedExtensions)) {
            $filename = \Illuminate\Support\Str::uuid() . '.' . $extension;
            $path = $file->storeAs('public/uploads', $filename);
            $url = asset(Storage::url($path));
            $uploadedFileUrl = $url . "\n";
        }
    }

    $nilaiFinal = $uploadedFileUrl . $nilai;

    Isian::updateOrCreate(
        ['subkriteria_id' => $subKriteriaId, 'akreditasi_id' => $akreditasiId],
        ['nilai' => $nilaiFinal]
    );

    $pesan = $action === 'submit' ? 'Data berhasil disubmit.' : 'Data berhasil disimpan.';
    return redirect()->back()->with('status', $pesan);
}



    private function getValidationLogs($kriteriaId, $subKriteriaId)
    {
        // Contoh dummy log, bisa diganti dengan query database
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
    // Ambil kriteria dengan subkriteria dan isian terkait
    $kriteria = Kriteria::with(['subkriteria' => function($query) {
        $query->with(['isian' => function($q) {
            $q->where('akreditasi_id', 1); // contoh filter akreditasi_id 1, bisa disesuaikan
        }]);
    }])->findOrFail($kriteriaId);

    // Data untuk view PDF
    $data = [
        'kriteria' => $kriteria,
    ];

    // Load view dan render PDF
    $pdf = Pdf::loadView('pdf.kriteria', $data)->setPaper('a4', 'portrait');

    // Download file PDF dengan nama kriteria
    return $pdf->download('Kriteria_'.$kriteria->id.'.pdf');
}

    
}
