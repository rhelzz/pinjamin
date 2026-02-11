<?php

use App\Http\Controllers\Admin\AlatController as AdminAlatController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\HistoryController as AdminHistoryController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Peminjam\BookingController;
use App\Http\Controllers\Peminjam\CartController;
use App\Http\Controllers\Peminjam\KatalogController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Petugas\ApprovalController;
use App\Http\Controllers\Petugas\HistoryController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\PengembalianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard router - redirects based on role
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Notifikasi routes (all authenticated users)
Route::middleware('auth')->prefix('notifikasi')->name('notifikasi.')->group(function () {
    Route::get('/', [NotifikasiController::class, 'index'])->name('index');
    Route::patch('/{id}/read', [NotifikasiController::class, 'markRead'])->name('read');
    Route::patch('/read-all', [NotifikasiController::class, 'markAllRead'])->name('readAll');
    Route::delete('/{id}', [NotifikasiController::class, 'destroy'])->name('destroy');
    Route::delete('/', [NotifikasiController::class, 'destroyAll'])->name('destroyAll');
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // CRUD Kategori
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // CRUD Alat
    Route::resource('alat', AdminAlatController::class)->except(['show']);

    // CRUD User
    Route::resource('user', UserController::class)->except(['show']);

    // User Approval
    Route::get('/user-approval', [UserController::class, 'pendingApproval'])->name('user.pending');
    Route::post('/user/{user}/approve', [UserController::class, 'approve'])->name('user.approve');
    Route::post('/user/{user}/reject', [UserController::class, 'reject'])->name('user.reject');

    // CRUD Denda
    Route::resource('denda', DendaController::class)->except(['show']);

    // Log Aktivitas
    Route::get('/log', [LogAktivitasController::class, 'index'])->name('log.index');

    // History Peminjaman untuk Admin
    Route::get('/history', [AdminHistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{peminjaman}', [AdminHistoryController::class, 'show'])->name('history.show');
});

// ==================== PETUGAS ROUTES ====================
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('dashboard');

    // Approval
    Route::get('/approval', [ApprovalController::class, 'index'])->name('approval.index');
    Route::get('/approval/{peminjaman}', [ApprovalController::class, 'show'])->name('approval.show');
    Route::post('/approval/{peminjaman}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
    Route::post('/approval/{peminjaman}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');

    // Pengembalian
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/{peminjaman}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{peminjaman}/create', [PengembalianController::class, 'create'])->name('pengembalian.create');

    // History Peminjaman untuk Petugas
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{peminjaman}', [HistoryController::class, 'show'])->name('history.show');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

// ==================== PEMINJAM ROUTES ====================
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'peminjam'])->name('dashboard');

    // Katalog
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/{alat}', [KatalogController::class, 'show'])->name('katalog.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{alat}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{alat}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{alat}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Booking (untuk barang yang sedang tidak tersedia)
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create/{alat}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{alat}', [BookingController::class, 'store'])->name('booking.store');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');

    // Riwayat Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
});

require __DIR__.'/auth.php';
