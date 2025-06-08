<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        $users = $usersQuery->paginate(10); // Fetch paginated users with search
        return view('superadmin.users.manage', compact('users', 'search'));
    }

    public function manageUser($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.manage', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id,
            'role' => 'required|in:Validator,Anggota,SuperAdmin', // Adjusted to match migration enum
            'is_active' => 'required|boolean'
        ]);

        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        // Prevent self-demotion or role change to lower than current user
        if ($user->id === $currentUser->id) {
            if ($request->role !== 'SuperAdmin') {
                return back()->with('error', 'You cannot change your own role from SuperAdmin!');
            }
        } elseif ($request->role === 'SuperAdmin' && $currentUser->role !== 'SuperAdmin') {
            return back()->with('error', 'You do not have permission to promote to SuperAdmin!');
        }

        $user->update($request->only(['name', 'username', 'role', 'is_active']));

        Log::info("SuperAdmin {$currentUser->name} updated user {$user->name} (ID: {$user->id})");

        return redirect()->route('superadmin.manage.users')
            ->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        // Prevent self-deletion
        if ($user->id === $currentUser->id) {
            return back()->with('error', 'You cannot delete yourself!');
        }

        $user->delete();

        Log::warning("SuperAdmin {$currentUser->name} deleted user {$user->name} (ID: {$user->id})");

        return redirect()->route('superadmin.manage.users')
            ->with('success', 'User deleted successfully');
    }

    public function manageKriteria()
    {
        $kriterias = Kriteria::paginate(10); // Fetch all kriteria for management
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

        // Send to Validators
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
        $users = User::all(); // Fetch all users for access management
        return view('superadmin.access.manage', compact('users'));
    }
}