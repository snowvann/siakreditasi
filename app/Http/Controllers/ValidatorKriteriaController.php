<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidatorKriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:validator']);
    }

    /**
     * Tampilkan dashboard validator dengan kriteria yang difilter dan diurutkan.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $activeTab = $request->input('tab', 'validation');
        $sortBy = $request->input('sort', 'newest');

        // Ambil semua kriteria
        $query = Kriteria::query();

        // Terapkan filter pencarian
        if ($search) {
            $query->where('nama_kriteria', 'like', '%' . $search . '%');
        }

        // Terapkan filter tab
        switch ($activeTab) {
            case 'validation':
                $query->where('status', 'pending');
                break;
            case 'revision':
                $query->where('status', 'needs_revision');
                break;
            case 'validated':
                $query->where('status', 'validated');
                break;
            // Tab 'all' menampilkan semua kriteria, tidak perlu filter tambahan
        }

        // Terapkan pengurutan
        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'priority-high':
                $query->orderBy('priority', 'desc');
                break;
            case 'priority-low':
                $query->orderBy('priority', 'asc');
                break;
        }

        $allKriteria = Kriteria::all();
        $filteredKriteria = $query->get();

        // Hitung statistik
        $pendingValidation = Kriteria::where('status', 'pending')->count();
        $needsRevision = Kriteria::where('status', 'needs_revision')->count();
        $validated = Kriteria::where('status', 'validated')->count();

        return view('validator-dashboard', compact(
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

    /**
     * Tampilkan halaman validasi kriteria.
     */
    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        return view('criteria-validation-view', compact('kriteria'));
    }

    /**
     * Tangani aksi validasi untuk kriteria.
     */
    public function validateKriteria(Request $request, $id)
    {
        $request->validate([
            'validationAction' => 'required|in:approve,reject,revise',
            'comment' => 'nullable|string|max:1000'
        ]);

        $kriteria = Kriteria::findOrFail($id);

        // Perbarui status kriteria berdasarkan aksi validasi
        switch ($request->validationAction) {
            case 'approve':
                $kriteria->status = 'validated';
                break;
            case 'reject':
                $kriteria->status = 'rejected';
                break;
            case 'revise':
                $kriteria->status = 'needs_revision';
                break;
        }

        // Simpan komentar
        $kriteria->validation_comment = $request->comment;
        $kriteria->last_updated_by = Auth::user()->name;
        $kriteria->last_updated = now();

        $kriteria->save();

        return redirect()->route('validator.dashboard')
            ->with('success', 'Validasi kriteria berhasil disimpan.');
    }
}