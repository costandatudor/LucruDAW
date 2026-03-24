<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'admin_users' => User::admins()->count(),
            'regular_users' => User::users()->count(),
            'total_news' => \App\Models\News::count(),
            'published_news' => \App\Models\News::published()->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentNews = \App\Models\News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentNews'));
    }

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilizatorul a fost creat cu succes!');
    }

    /**
     * Show edit user form
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Utilizatorul a fost actualizat cu succes!');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'Nu vă puteți șterge propriul cont!');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilizatorul a fost șters cu succes!');
    }

    /**
     * Toggle user role
     */
    public function toggleRole(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'Nu vă puteți modifica propriul rol!');
        }

        if ($user->isAdmin()) {
            $user->makeUser();
            $message = 'Utilizatorul a fost retrogradat la utilizator normal.';
        } else {
            $user->makeAdmin();
            $message = 'Utilizatorul a fost promovat la administrator.';
        }

        return redirect()->route('admin.users')->with('success', $message);
    }
}
