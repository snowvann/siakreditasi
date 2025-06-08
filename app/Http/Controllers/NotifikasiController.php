<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        try {
            $notifikasi = Notifikasi::where('user_id', auth()->id())
                ->latest()
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $notifikasi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil notifikasi'
            ], 500);
        }
    }

    public function tandaiDibaca($id)
    {
        try {
            $notif = Notifikasi::where('user_id', auth()->id())
                ->where('id', $id)
                ->firstOrFail();

            $notif->update(['dibaca' => true]);

            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi berhasil ditandai sebagai dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Notifikasi tidak ditemukan atau gagal diupdate'
            ], 404);
        }
    }

    public function tandaiSemuaDibaca()
    {
        try {
            Notifikasi::where('user_id', auth()->id())
                ->where('dibaca', false)
                ->update(['dibaca' => true]);

            return response()->json([
                'status' => 'success',
                'message' => 'Semua notifikasi berhasil ditandai sebagai dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menandai semua notifikasi'
            ], 500);
        }
    }

    public function hapus($id)
    {
        try {
            $notif = Notifikasi::where('user_id', auth()->id())
                ->where('id', $id)
                ->firstOrFail();

            $notif->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Notifikasi tidak ditemukan atau gagal dihapus'
            ], 404);
        }
    }
}