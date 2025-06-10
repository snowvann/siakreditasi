<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Notifikasi;

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

        // User Management Query
        $userQuery = User::query();
        $kriteriaQuery = Kriteria::query();

        // Search functionality
        if ($search) {
            $userQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });

            $kriteriaQuery->where(function ($q) use ($search) {
                $q->where('nama_kriteria', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
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
            SUM(CASE WHEN role = "Admin" THEN 1 ELSE 0 END) as total_admins,
            SUM(CASE WHEN role = "Validator" THEN 1 ELSE 0 END) as total_validators
        ')->first() ?? ['total_users' => 0, 'total_admins' => 0, 'total_validators' => 0];

        // Extract values from $stats
        $totalUsers = $stats->total_users;
        $totalAdmins = $stats->total_admins;
        $totalValidators = $stats->total_validators;
        $totalKriteria = Kriteria::count();
        $validatedKriteria = Kriteria::where('status', 'validated')->count();
        $pendingReview = Kriteria::where('status', 'pending')->count();

        // Recent activities (example data, replace with actual logic if needed)
        $recentActivities = [
            ['title' => 'User baru ditambahkan', 'by' => 'Dr. Ahmad Rahman', 'time' => '2 jam yang lalu'],
            ['title' => 'Kriteria 3 divalidasi', 'by' => 'Prof. Dr. Siti Aminah', 'time' => '4 jam yang lalu'],
            ['title' => 'Akses kriteria diperbarui', 'by' => 'Super Admin', 'time' => '6 jam yang lalu'],
            ['title' => 'Subkriteria baru ditambahkan', 'by' => 'Admin', 'time' => '1 hari yang lalu'],
        ];

        return view('superadmin/dashboard', compact(
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

    public function manageUsers(Request $request)
    {
        $search = $request->input('search', '');
        $usersQuery = User::query();

        // Search functionality
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

    // API untuk mendapatkan data user untuk edit modal
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
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    // Menambah user baru
    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username|max:255',
                'role' => 'required|in:anggota,validator,superadmin',
                'is_active' => 'required|boolean'
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make('password123'), // Default password
                'role' => $request->role,
                'is_active' => $request->is_active
            ]);

            Log::info("SuperAdmin " . Auth::user()->name . " added new user: {$user->name}");

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            Log::error("Error adding user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'role' => 'required|in:anggota,validator,superadmin',
                'is_active' => 'required|boolean'
            ]);

            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            if ($user->id === $currentUser->id && $request->role !== 'superadmin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat mengubah role diri sendiri!'
                ], 403);
            }

            $user->update($request->only(['name', 'username', 'role', 'is_active']));

            Log::info("SuperAdmin {$currentUser->name} updated user {$user->name} (ID: {$user->id})");

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error("Error updating user: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage()
            ], 500);
        }
    }


    // Delete user
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            // Prevent self-deletion
            if ($user->id === $currentUser->id) {
                return redirect()->back()->with('error', 'Anda tidak dapat menghapus diri sendiri!');
            }

            $userName = $user->name;
            $user->delete();

            Log::warning("SuperAdmin {$currentUser->name} deleted user {$userName} (ID: {$id})");

            return redirect()->route('superadmin.manage.users')
                ->with('success', "User {$userName} berhasil dihapus");
        } catch (\Exception $e) {
            Log::error("Error deleting user: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus user');
        }
    }

    public function manageKriteria()
    {
        $kriterias = Kriteria::paginate(10);
        return view('superadmin.kriteria.manage', compact('kriterias'));
    }

    public function manageKriteriaDetail($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('superadmin.kriteria.manage', compact('kriteria'));
    }

    public function updateKriteria(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:pending,needs_revision,validated'
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->only(['nama_kriteria', 'deskripsi', 'status']));

        $this->sendKriteriaUpdateNotification($kriteria, Auth::user());

        return redirect()->route('superadmin.manage.kriteria')
            ->with('success', 'Kriteria updated successfully');
    }

    private function sendKriteriaUpdateNotification($kriteria, $superadmin)
    {
        $judul = "Kriteria {$kriteria->nama_kriteria} Diperbarui";
        $pesan = "SuperAdmin {$superadmin->name} telah memperbarui kriteria ini";

        $recipients = User::where('role', 'Validator')->get();

        foreach ($recipients as $recipient) {
            Notifikasi::create([
                'user_id' => $recipient->id,
                'judul' => $judul,
                'pesan' => $pesan,
                'dibaca' => false,
            ]);
        }

        Log::info("Notifikasi update kriteria dikirim ke {$recipients->count()} recipients (Validators)");
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
}