<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Isian;

use App\Models\Notifikasi;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;



class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:SuperAdmin']);
    }

    public function dashboard(Request $request)
    {
        $search = $request->input('search', '');
        $activeTab = $request->input('tab', 'users');
        $sortBy = $request->input('sort', 'newest');

        // User and Kriteria Queries
        $userQuery = User::query();
        $kriteriaQuery = Kriteria::with('subkriteria');

        // Search functionality
        if ($search) {
            $userQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });

            $kriteriaQuery->where(function ($q) use ($search) {
                $q->where('nama_kriteria', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('subkriteria', function ($subQuery) use ($search) {
                      $subQuery->where('nama_subkriteria', 'like', "%{$search}%")
                               ->orWhere('deskripsi', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        switch ($sortBy) {
            case 'newest':
                $userQuery->latest('created_at');
                $kriteriaQuery->latest('created_at');
                break;
            case 'oldest':
                $userQuery->oldest('created_at');
                $kriteriaQuery->oldest('created_at');
                break;
            case 'name-asc':
                $userQuery->orderBy('name', 'asc');
                $kriteriaQuery->orderBy('nama_kriteria', 'asc');
                break;
            case 'name-desc':
                $userQuery->orderBy('name', 'desc');
                $kriteriaQuery->orderBy('nama_kriteria', 'desc');
                break;
        }

        // Get data based on active tab
        $data = match ($activeTab) {
            'users' => $userQuery->paginate(10),
            'kriteria' => $kriteriaQuery->paginate(10),
            default => $userQuery->paginate(10),
        };

        // Calculate stats with optimization
        $stats = User::selectRaw('
            COUNT(*) as total_users,
            SUM(CASE WHEN role = "SuperAdmin" THEN 1 ELSE 0 END) as total_admins,
            SUM(CASE WHEN role = "Validator" THEN 1 ELSE 0 END) as total_validators
        ')->first() ?? ['total_users' => 0, 'total_admins' => 0, 'total_validators' => 0];

        // Extract values from $stats
        $totalUsers = $stats->total_users;
        $totalAdmins = $stats->total_admins;
        $totalValidators = $stats->total_validators;
        $totalKriteria = Kriteria::count();
        $validatedKriteria = Kriteria::where('status', 'validated')->count();
        $pendingReview = Kriteria::where('status', 'pending')->count();

        // Fetch recent activities from audit_logs
        $recentActivities = AuditLog::with('user')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(function ($log) {
                return [
                    'title' => $log->aksi,
                    'by' => $log->user ? $log->user->name : 'System',
                    'time' => $log->created_at->diffForHumans(),
                ];
            });

        return view('superadmin.dashboard', compact(
            'data',
            'totalUsers',
            'totalAdmins',
            'totalValidators',
            'totalKriteria',
            'validatedKriteria',
            'pendingReview',
            'recentActivities',
            'activeTab',
            'sortBy',
            'search'
        ));
    }

        public function riwayatIsian(Request $request)
    {
        $search = $request->input('search', '');
        $sortBy = $request->input('sort', 'newest');
        $filterKriteria = $request->input('kriteria', '');
        $filterUser = $request->input('user', '');

        // Query untuk mengambil data isian dengan relasi
        $isianQuery = Isian::with(['user', 'subkriteria.kriteria', 'akreditasi'])
            ->select('t_isian.*');

        // Search functionality
        if ($search) {
            $isianQuery->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                })
                ->orWhereHas('subkriteria', function ($subQuery) use ($search) {
                    $subQuery->where('nama_subkriteria', 'like', "%{$search}%")
                            ->orWhereHas('kriteria', function ($kriteriaQuery) use ($search) {
                                $kriteriaQuery->where('nama_kriteria', 'like', "%{$search}%");
                            });
                })
                ->orWhere('nilai', 'like', "%{$search}%");
            });
        }

        // Filter by kriteria
        if ($filterKriteria) {
            $isianQuery->whereHas('subkriteria.kriteria', function ($q) use ($filterKriteria) {
                $q->where('id', $filterKriteria);
            });
        }

        // Filter by user
        if ($filterUser) {
            $isianQuery->where('user_id', $filterUser);
        }

        // Sorting
        switch ($sortBy) {
            case 'newest':
                $isianQuery->latest('updated_at');
                break;
            case 'oldest':
                $isianQuery->oldest('updated_at');
                break;
            case 'user-asc':
                $isianQuery->join('users', 't_isian.user_id', '=', 'users.id')
                        ->orderBy('users.name', 'asc');
                break;
            case 'user-desc':
                $isianQuery->join('users', 't_isian.user_id', '=', 'users.id')
                        ->orderBy('users.name', 'desc');
                break;
            case 'kriteria-asc':
                $isianQuery->join('subkriteria', 't_isian.subkriteria_id', '=', 'subkriteria.id')
                        ->join('kriteria', 'subkriteria.kriteria_id', '=', 'kriteria.id')
                        ->orderBy('kriteria.nama_kriteria', 'asc');
                break;
            case 'kriteria-desc':
                $isianQuery->join('subkriteria', 't_isian.subkriteria_id', '=', 'subkriteria.id')
                        ->join('kriteria', 'subkriteria.kriteria_id', '=', 'kriteria.id')
                        ->orderBy('kriteria.nama_kriteria', 'desc');
                break;
        }

        // Paginate results
        $isian = $isianQuery->paginate(15)->appends($request->query());

        // Get data for filter dropdowns
        $kriteria = Kriteria::orderBy('nama_kriteria')->get();
        $users = User::orderBy('name')->get();

        // Statistics
        $stats = [
            'total_isian' => Isian::count(),
            'total_users_pengisi' => Isian::distinct('user_id')->count(),
            'total_kriteria_diisi' => Isian::join('subkriteria', 't_isian.subkriteria_id', '=', 'subkriteria.id')
                                            ->distinct('subkriteria.kriteria_id')
                                            ->count(),
            'total_subkriteria_diisi' => Isian::distinct('subkriteria_id')->count(),
        ];

        return view('superadmin.riwayat-isian', compact(
            'isian',
            'kriteria',
            'users',
            'stats',
            'search',
            'sortBy',
            'filterKriteria',
            'filterUser'
        ));
    }

    public function manageUsers(Request $request)
    {
        $search = $request->input('search', '');
        $usersQuery = User::query();

        if ($search) {
            $usersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $users = $usersQuery->paginate(10);
        return view('superadmin.users.manage', compact('users', 'search'));
    }

    public function getUserData($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'role' => $user->role,
                    'is_active' => $user->is_active
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username|max:255',
                'role' => 'required|in:Anggota,Validator,SuperAdmin',
                'is_active' => 'required|boolean'
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make('password123'),
                'role' => $request->role,
                'is_active' => $request->is_active
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " added new user: {$user->name}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Tambah User',
                'deskripsi' => "Menambahkan user {$user->name} dengan role {$user->role}",
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error adding user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'role' => 'required|in:Anggota,Validator,SuperAdmin',
                'is_active' => 'required|boolean'
            ]);

            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            if ($user->id === $currentUser->id && $request->role !== 'SuperAdmin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat mengubah role diri sendiri!'
                ], 403);
            }

            $user->update($request->only(['name', 'username', 'role', 'is_active']));

            Log::info("SuperAdmin {$currentUser->name} updated user {$user->name} (ID: {$user->id})");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Update User',
                'deskripsi' => "Memperbarui user {$user->name} dengan role {$user->role}",
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error updating user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            if ($user->id === $currentUser->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menghapus diri sendiri!'
                ], 403);
            }

            $userName = $user->name;
            $user->delete();

            Log::warning("SuperAdmin {$currentUser->name} deleted user {$userName} (ID: {$id})");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Hapus User',
                'deskripsi' => "Menghapus user {$userName}",
                'ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "User {$userName} berhasil dihapus"
            ]);
        } catch (\Exception $e) {
            Log::error("Error deleting user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function manageKriteria()
    {
        // Pastikan Anda mengambil data kriteria, misalnya:
        $kriteriaList = Kriteria::with('subKriteria')->get(); // sesuaikan dengan model Anda

        // Kirimkan variabel ke view
        return view('superadmin.kriteria.manage', compact('kriteriaList'));
    }


    public function getCriteria(Request $request)
    {
        $search = $request->input('search', '');
        $kriterias = Kriteria::with('subkriteria')
            ->when($search, function ($query, $search) {
                $query->where('nama_kriteria', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhereHas('subkriteria', function ($q) use ($search) {
                          $q->where('nama_subkriteria', 'like', "%{$search}%")
                            ->orWhere('deskripsi', 'like', "%{$search}%");
                      });
            })
            ->get();

        return response()->json(['success' => true, 'criteria' => $kriterias]);
    }

    public function getCriteriaById($id)
    {
        try {
            $kriteria = Kriteria::with('subkriteria')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $kriteria]);
        } catch (\Exception $e) {
            Log::error("Error fetching criteria: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Kriteria tidak ditemukan'], 404);
        }
    }

    public function storeCriteria(Request $request)
    {
        try {
            $request->validate([
                'nama_kriteria' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'status' => 'required|in:pending,needs_revision,validated',
            ]);

            $kriteria = Kriteria::create([
                'nama_kriteria' => $request->nama_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " added new criteria: {$kriteria->nama_kriteria}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Tambah Kriteria',
                'deskripsi' => "Menambahkan kriteria {$kriteria->nama_kriteria}",
                'ip' => $request->ip(),
            ]);

            $this->sendKriteriaUpdateNotification($kriteria, Auth::user(), 'dibuat');

            return response()->json(['success' => true, 'message' => 'Kriteria berhasil ditambahkan']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error adding criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateKriteria(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_kriteria' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'status' => 'required|in:pending,needs_revision,validated',
            ]);

            $kriteria = Kriteria::findOrFail($id);
            $kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " updated criteria: {$kriteria->nama_kriteria}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Update Kriteria',
                'deskripsi' => "Memperbarui kriteria {$kriteria->nama_kriteria}",
                'ip' => $request->ip(),
            ]);

            $this->sendKriteriaUpdateNotification($kriteria, Auth::user(), 'diperbarui');

            return response()->json(['success' => true, 'message' => 'Kriteria berhasil diperbarui']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error updating criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteKriteria($id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteriaName = $kriteria->nama_kriteria;
            $kriteria->delete();

            Log::warning("SuperAdmin " . Auth::user()->name . " deleted criteria: {$kriteriaName}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Hapus Kriteria',
                'deskripsi' => "Menghapus kriteria {$kriteriaName}",
                'ip' => request()->ip(),
            ]);

            $this->sendKriteriaUpdateNotification((object)['nama_kriteria' => $kriteriaName], Auth::user(), 'dihapus');

            return response()->json(['success' => true, 'message' => 'Kriteria berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error("Error deleting criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeSubKriteria(Request $request)
    {
        try {
            $request->validate([
                'kriteria_id' => 'required|exists:kriteria,id',
                'nama_subkriteria' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
            ]);

            $subKriteria = SubKriteria::create([
                'kriteria_id' => $request->kriteria_id,
                'nama_subkriteria' => $request->nama_subkriteria,
                'deskripsi' => $request->deskripsi,
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " added new sub-criteria: {$subKriteria->nama_subkriteria} for criteria ID: {$subKriteria->kriteria_id}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Tambah Sub-Kriteria',
                'deskripsi' => "Menambahkan sub-kriteria {$subKriteria->nama_subkriteria} untuk kriteria ID {$subKriteria->kriteria_id}",
                'ip' => $request->ip(),
            ]);

            $this->sendSubKriteriaUpdateNotification($subKriteria, Auth::user(), 'dibuat');

            return response()->json(['success' => true, 'message' => 'Sub-Kriteria berhasil ditambahkan']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error adding sub-criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSubKriteriaById($id)
    {
        try {
            $subKriteria = SubKriteria::findOrFail($id);
            return response()->json(['success' => true, 'data' => $subKriteria]);
        } catch (\Exception $e) {
            Log::error("Error fetching sub-criteria: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Sub-Kriteria tidak ditemukan'], 404);
        }
    }

    public function updateSubKriteria(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_subkriteria' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
            ]);

            $subKriteria = SubKriteria::findOrFail($id);
            $subKriteria->update([
                'nama_subkriteria' => $request->nama_subkriteria,
                'deskripsi' => $request->deskripsi,
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " updated sub-criteria: {$subKriteria->nama_subkriteria}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Update Sub-Kriteria',
                'deskripsi' => "Memperbarui sub-kriteria {$subKriteria->nama_subkriteria}",
                'ip' => $request->ip(),
            ]);

            $this->sendSubKriteriaUpdateNotification($subKriteria, Auth::user(), 'diperbarui');

            return response()->json(['success' => true, 'message' => 'Sub-Kriteria berhasil diperbarui']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error("Error updating sub-criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteSubKriteria($id)
    {
        try {
            $subKriteria = SubKriteria::findOrFail($id);
            $subKriteriaName = $subKriteria->nama_subkriteria;
            $kriteriaId = $subKriteria->kriteria_id;
            $subKriteria->delete();

            Log::warning("SuperAdmin " . Auth::user()->name . " deleted sub-criteria: {$subKriteriaName}");
            AuditLog::create([
                'user_id' => Auth::id(),
                'aksi' => 'Hapus Sub-Kriteria',
                'deskripsi' => "Menghapus sub-kriteria {$subKriteriaName} dari kriteria ID {$kriteriaId}",
                'ip' => request()->ip(),
            ]);

            $this->sendSubKriteriaUpdateNotification((object)['nama_subkriteria' => $subKriteriaName, 'kriteria_id' => $kriteriaId], Auth::user(), 'dihapus');

            return response()->json(['success' => true, 'message' => 'Sub-Kriteria berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error("Error deleting sub-criteria: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sub-kriteria: ' . $e->getMessage()
            ], 500);
        }
    }

    public function manageAccess()
    {
        $users = User::all();
        return view('superadmin.access.manage', compact('users'));
    }

    public function manageUser($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.detail', compact('user'));
    }

    private function sendKriteriaUpdateNotification($kriteria, $superadmin, $action)
    {
        $judul = "Kriteria {$kriteria->nama_kriteria} " . ucfirst($action);
        $pesan = "SuperAdmin {$superadmin->name} telah {$action} kriteria {$kriteria->nama_kriteria}";

        $recipients = User::where('role', 'Validator')->get();

        foreach ($recipients as $recipient) {
            Notifikasi::create([
                'user_id' => $recipient->id,
                'judul' => $judul,
                'pesan' => $pesan,
                'dibaca' => false,
            ]);
        }

        Log::info("Notifikasi {$action} kriteria dikirim ke {$recipients->count()} recipients (Validators)");
    }

    private function sendSubKriteriaUpdateNotification($subKriteria, $superadmin, $action)
    {
        $kriteria = Kriteria::find($subKriteria->kriteria_id);
        $judul = "Sub-Kriteria {$subKriteria->nama_subkriteria} " . ucfirst($action);
        $pesan = "SuperAdmin {$superadmin->name} telah {$action} sub-kriteria {$subKriteria->nama_subkriteria} pada kriteria {$kriteria->nama_kriteria}";

        $recipients = User::where('role', 'Validator')->get();

        foreach ($recipients as $recipient) {
            Notifikasi::create([
                'user_id' => $recipient->id,
                'judul' => $judul,
                'pesan' => $pesan,
                'dibaca' => false,
            ]);
        }

        Log::info("Notifikasi {$action} sub-kriteria dikirim ke {$recipients->count()} recipients (Validators)");
    }

    
}