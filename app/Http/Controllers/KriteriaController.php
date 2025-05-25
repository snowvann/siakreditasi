<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function show($id)
    {
        // Hardcoded data for kriteria
        $kriteriaData = [
            'id' => $id,
            'nama_kriteria' => $this->getKriteriaName($id),
            'deskripsi' => 'Deskripsi lengkap untuk kriteria ini yang menjelaskan apa yang perlu diisi.',
            'status' => $this->getKriteriaStatus($id),
            'progress' => $this->getKriteriaProgress($id),
            'updated_at' => '12 Mei 2025'
        ];

        // Hardcoded anggota kriteria
        $anggotaKriteria = [
            ['id' => 1, 'name' => 'Dr. Budi Santoso, M.Pd.'],
            ['id' => 2, 'name' => 'Dr. Siti Rahayu, M.Si.']
        ];

        // Hardcoded sub-kriteria
        $subKriteriaList = $this->getSubKriteriaList($id);

        return view('kriteria.show', [
            'kriteriaId' => $id,
            'kriteriaData' => $kriteriaData,
            'anggotaKriteria' => $anggotaKriteria,
            'subKriteriaList' => $subKriteriaList
        ]);
    }

    private function getKriteriaName($id)
    {
        switch ($id) {
            case 1: return "Visi, Misi, Tujuan dan Strategi";
            case 2: return "Tata Pamong, Tata Kelola dan Kerjasama";
            case 3: return "Mahasiswa";
            case 4: return "Sumber Daya Manusia";
            default: return "Kriteria " . $id;
        }
    }

    private function getKriteriaStatus($id)
    {
        if ($id <= 2) return "validated";
        if ($id == 3) return "menunggu_validasi";
        if ($id == 4) return "revisi";
        return "draft";
    }

    private function getKriteriaProgress($id)
    {
        if ($id <= 3) return 100;
        if ($id == 4) return 60;
        if ($id == 5) return 40;
        return 0;
    }

    private function getSubKriteriaList($kriteriaId)
    {
        $baseSubKriteria = [
            ['id' => 1, 'nama_subkriteria' => 'Penetapan', 'urutan' => 1],
            ['id' => 2, 'nama_subkriteria' => 'Pelaksanaan', 'urutan' => 2],
            ['id' => 3, 'nama_subkriteria' => 'Evaluasi', 'urutan' => 3],
            ['id' => 4, 'nama_subkriteria' => 'Pengendalian', 'urutan' => 4],
            ['id' => 5, 'nama_subkriteria' => 'Peningkatan', 'urutan' => 5],
        ];

        return array_map(function ($item) use ($kriteriaId) {
            $item['status'] = $this->getSubKriteriaStatus($kriteriaId, $item['id']);
            return $item;
        }, $baseSubKriteria);
    }

    private function getSubKriteriaStatus($kriteriaId, $subKriteriaId)
    {
        if ($kriteriaId <= 2) return "validated";
        if ($kriteriaId == 3) return "menunggu_validasi";
        if ($kriteriaId == 4) return "revisi";
        if ($kriteriaId == 5 && $subKriteriaId == 3) return "draft";
        return "draft";
    }

    public function showSubKriteria($kriteriaId, $subKriteriaId)
{
    // Hardcoded data for sub-kriteria
    $subKriteria = [
        'id' => $subKriteriaId,
        'nama_subkriteria' => "Sub-kriteria $subKriteriaId",
        'urutan' => $subKriteriaId,
        'status' => $this->getSubKriteriaStatus($kriteriaId, $subKriteriaId),
    ];

    // Hardcoded akreditasi data
    $akreditasi = [
        'isi' => $this->getAkreditasiContent($kriteriaId, $subKriteriaId),
        'file_path' => $kriteriaId <= 2 ? "/uploads/dokumen-pendukung.pdf" : "",
        'komentar' => $kriteriaId === 4 && $subKriteriaId <= 2 ? "Data perlu dilengkapi dengan bukti pendukung yang lebih detail." : "",
        'updated_at' => "12 Mei 2025",
    ];

    // Hardcoded validation logs
    $validasiLogs = $this->getValidationLogs($kriteriaId, $subKriteriaId);

    return view('kriteria.subkriteria.show', compact('kriteriaId', 'subKriteriaId', 'subKriteria', 'akreditasi', 'validasiLogs'));
}

private function getAkreditasiContent($kriteriaId, $subKriteriaId)
{
    if ($kriteriaId <= 3 || ($kriteriaId === 4 && $subKriteriaId <= 2)) {
        return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
    }
    return "";
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
}