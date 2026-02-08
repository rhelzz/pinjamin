<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $users = User::with('role')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%"))
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:role,id',
            'status' => 'required|in:active,pending,blacklist',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
            'email_verified_at' => now(),
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menambahkan user: {$user->name} ({$user->username})",
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:role,id',
            'status' => 'required|in:active,pending,blacklist',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'username', 'email', 'role_id', 'status']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Mengubah user: {$user->name} (Role: {$user->role->nama_role}, Status: {$user->status})",
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $nama = $user->name;
        $user->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menghapus user: {$nama}",
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
