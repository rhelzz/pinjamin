<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
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

    /**
     * Display pending user approvals.
     */
    public function pendingApproval(Request $request)
    {
        $users = User::with('role')
            ->where('status', 'pending')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.user.pending', compact('users'));
    }

    /**
     * Approve a pending user.
     */
    public function approve(User $user)
    {
        if ($user->status !== 'pending') {
            return back()->with('error', 'User ini tidak dalam status pending.');
        }

        $user->update([
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Kirim notifikasi ke user
        Notifikasi::create([
            'user_id' => $user->id,
            'pesan' => 'Selamat! Akun Anda telah disetujui. Anda sekarang dapat login dan menggunakan sistem.',
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menyetujui pendaftaran user: {$user->name} ({$user->email})",
        ]);

        return back()->with('success', "User {$user->name} berhasil disetujui.");
    }

    /**
     * Reject a pending user.
     */
    public function reject(Request $request, User $user)
    {
        if ($user->status !== 'pending') {
            return back()->with('error', 'User ini tidak dalam status pending.');
        }

        $reason = $request->input('reason', 'Tidak memenuhi kriteria');

        // Kirim notifikasi ke user sebelum dihapus (opsional, bisa disimpan di log)
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => "Menolak pendaftaran user: {$user->name} ({$user->email}). Alasan: {$reason}",
        ]);

        // Hapus user yang ditolak
        $user->delete();

        return back()->with('success', 'Pendaftaran user berhasil ditolak.');
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
