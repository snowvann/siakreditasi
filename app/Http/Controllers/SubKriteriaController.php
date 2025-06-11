<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubKriteriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_subkriteria' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persentase' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $subkriteria = SubKriteria::create([
                'kriteria_id' => $request->kriteria_id,
                'nama_subkriteria' => $request->nama_subkriteria,
                'deskripsi' => $request->deskripsi,
                'persentase' => $request->persentase
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sub-Kriteria berhasil ditambahkan',
                'data' => $subkriteria
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing subkriteria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $subkriteria = SubKriteria::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $subkriteria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sub-Kriteria tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_subkriteria' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'persentase' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $subkriteria = SubKriteria::findOrFail($id);
            $subkriteria->update([
                'nama_subkriteria' => $request->nama_subkriteria,
                'deskripsi' => $request->deskripsi,
                'persentase' => $request->persentase
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sub-Kriteria berhasil diperbarui',
                'data' => $subkriteria
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating subkriteria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subkriteria = SubKriteria::findOrFail($id);
            $subkriteria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sub-Kriteria berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting subkriteria: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }
}