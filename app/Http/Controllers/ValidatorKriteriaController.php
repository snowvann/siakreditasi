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

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $activeTab = $request->input('tab', 'validation');
        $sortBy = $request->input('sort', 'newest');

        $query = Kriteria::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kriteria', 'like', '%'.$search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

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
        }

        switch ($sortBy) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'priority-high':
                $query->orderBy('priority', 'desc');
                break;
            case 'priority-low':
                $query->orderBy('priority', 'asc');
                break;
        }

        $allKriteria = Kriteria::all();
        $filteredKriteria = $query->paginate(10);

        $pendingValidation = Kriteria::where('status', 'pending')->count();
        $needsRevision = Kriteria::where('status', 'needs_revision')->count();
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
    $pdfUrl = $kriteria->pdf_path ? asset($kriteria->pdf_path) : null;

    return view('validator.kriteria-validation', compact('kriteria', 'pdfUrl'));
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
                $kriteria->status = 'needs_revision';
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
    
}
