# 📗 Dokumentasi Teknis - Pinjamin

Dokumentasi teknis lengkap mencakup arsitektur, database, API, dan penjelasan kode.

---

## 📋 Daftar Isi

- [Arsitektur Aplikasi](#arsitektur-aplikasi)
- [Struktur Database](#struktur-database)
- [Models & Relationships](#models--relationships)
- [Controllers](#controllers)
- [Middleware](#middleware)
- [Routes](#routes)
- [Views & Components](#views--components)
- [Authentication & Authorization](#authentication--authorization)
- [Seeder](#seeder)
- [Testing](#testing)

---

## Arsitektur Aplikasi

### Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 11, PHP 8.2+ |
| Frontend | Blade, TailwindCSS 3, Alpine.js 3 |
| Database | MySQL 8 / MariaDB 10 |
| Build Tool | Vite |
| Authentication | Laravel Breeze |
| Testing | Pest PHP |

### Design Pattern

Aplikasi menggunakan **MVC (Model-View-Controller)** dengan struktur:

```
Request → Route → Middleware → Controller → Model → View
```

### Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/           # Controllers untuk admin
│   │   │   ├── AlatController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DendaController.php
│   │   │   ├── HistoryController.php
│   │   │   ├── KategoriController.php
│   │   │   ├── LogController.php
│   │   │   └── UserController.php
│   │   ├── Peminjam/        # Controllers untuk peminjam
│   │   │   ├── BookingController.php
│   │   │   ├── CartController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── KatalogController.php
│   │   │   └── PeminjamanController.php
│   │   ├── Petugas/         # Controllers untuk petugas
│   │   │   ├── ApprovalController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── HistoryController.php
│   │   │   ├── LaporanController.php
│   │   │   └── PengembalianController.php
│   │   ├── NotifikasiController.php
│   │   └── ProfileController.php
│   ├── Middleware/
│   │   ├── RoleMiddleware.php       # Cek role user
│   │   └── StatusMiddleware.php     # Cek status aktif user
│   └── Requests/            # Form Request Validation
├── Models/
│   ├── Alat.php
│   ├── Booking.php
│   ├── Denda.php
│   ├── Kategori.php
│   ├── LogAktivitas.php
│   ├── Notifikasi.php
│   ├── Peminjaman.php
│   ├── PeminjamanDetail.php
│   ├── Pengembalian.php
│   ├── Role.php
│   └── User.php
└── View/
    └── Components/
        └── AppLayout.php
```

---

## Struktur Database

### Entity Relationship Diagram

```
┌─────────────┐       ┌─────────────┐
│    Role     │       │   Kategori  │
├─────────────┤       ├─────────────┤
│ id          │       │ id          │
│ nama_role   │       │ nama_kategori│
└──────┬──────┘       └──────┬──────┘
       │                     │
       │ 1                   │ 1
       │                     │
       │ *                   │ *
┌──────┴──────┐       ┌──────┴──────┐
│    User     │       │    Alat     │
├─────────────┤       ├─────────────┤
│ id          │       │ id          │
│ name        │       │ nama_alat   │
│ username    │       │ kategori_id │──FK
│ email       │       │ stok        │
│ password    │       │ gambar      │
│ role_id     │──FK   │ deskripsi   │
│ status      │       └──────┬──────┘
└──────┬──────┘              │
       │                     │
       │ 1                   │
       │                     │
       │ *                   │ *
┌──────┴──────┐       ┌──────┴──────┐
│ Peminjaman  │       │  Peminjaman │
├─────────────┤       │   Detail    │
│ id          │◄──────┤─────────────┤
│ user_id     │──FK   │ id          │
│ tanggal_pinjam      │ peminjaman_id──FK
│ tanggal_kembali     │ alat_id     │──FK
│ status      │       │ jumlah      │
│ alasan_tolak│       └─────────────┘
│ approved_by │──FK
│ approved_at │
│ returned_by │──FK
│ returned_at │
└──────┬──────┘
       │
       │ 1
       │
       │ 1
┌──────┴──────┐
│Pengembalian │
├─────────────┤
│ id          │
│ peminjaman_id──FK
│ tanggal_dikembalikan
│ denda       │
│ kondisi     │
│ catatan     │
└─────────────┘
```

### Tabel Database

#### 1. Role
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| nama_role | string | Nama role (Admin/Petugas/Peminjam) |
| timestamps | - | created_at, updated_at |

#### 2. Users
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Nama lengkap |
| username | string | Username unik |
| email | string | Email unik |
| email_verified_at | timestamp | Waktu verifikasi email |
| password | string | Password (hashed) |
| role_id | bigint | FK ke role |
| status | enum | active/pending/blacklist |
| remember_token | string | Token remember me |
| timestamps | - | created_at, updated_at |

#### 3. Kategori
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| nama_kategori | string | Nama kategori |
| timestamps | - | created_at, updated_at |

#### 4. Alat
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| nama_alat | string | Nama alat |
| kategori_id | bigint | FK ke kategori |
| stok | integer | Jumlah stok tersedia |
| gambar | string | Path gambar (nullable) |
| deskripsi | text | Deskripsi alat (nullable) |
| timestamps | - | created_at, updated_at |

#### 5. Peminjaman
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | FK ke users (peminjam) |
| tanggal_pinjam | datetime | Tanggal mulai pinjam |
| tanggal_kembali | datetime | Target tanggal kembali |
| status | enum | Pending/Dipinjam/Ditolak/Selesai |
| alasan_tolak | text | Alasan jika ditolak |
| approved_by | bigint | FK ke users (petugas) |
| approved_at | timestamp | Waktu approval |
| returned_by | bigint | FK ke users (petugas) |
| returned_at | timestamp | Waktu pengembalian |
| timestamps | - | created_at, updated_at |

#### 6. Peminjaman Detail
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| peminjaman_id | bigint | FK ke peminjaman |
| alat_id | bigint | FK ke alat |
| jumlah | integer | Jumlah alat dipinjam |
| timestamps | - | created_at, updated_at |

#### 7. Pengembalian
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| peminjaman_id | bigint | FK ke peminjaman |
| tanggal_dikembalikan | date | Tanggal dikembalikan |
| denda | decimal(12,2) | Total denda |
| kondisi | enum | Baik/Rusak |
| catatan | text | Catatan (nullable) |
| timestamps | - | created_at, updated_at |

#### 8. Denda
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| nama_denda | string | Nama tarif denda |
| tipe | enum | per_jam/per_hari/tetap |
| nominal | decimal(12,2) | Nominal denda |
| deskripsi | text | Deskripsi (nullable) |
| aktif | boolean | Status aktif |
| timestamps | - | created_at, updated_at |

#### 9. Booking
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | FK ke users |
| alat_id | bigint | FK ke alat |
| jumlah | integer | Jumlah booking |
| tanggal_booking | date | Tanggal ingin pinjam |
| tanggal_kembali | date | Target kembali |
| status | enum | Menunggu/Disetujui/Ditolak/Selesai |
| referensi_peminjaman_id | bigint | FK ke peminjaman yang ditunggu |
| catatan | text | Catatan (nullable) |
| timestamps | - | created_at, updated_at |

#### 10. Notifikasi
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | FK ke users |
| pesan | text | Isi pesan notifikasi |
| is_read | boolean | Status sudah dibaca |
| timestamps | - | created_at, updated_at |

#### 11. Log Aktivitas
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | FK ke users (nullable) |
| aktivitas | text | Deskripsi aktivitas |
| timestamp | timestamp | Waktu aktivitas |
| timestamps | - | created_at, updated_at |

---

## Models & Relationships

### User Model

```php
// app/Models/User.php

class User extends Authenticatable
{
    // Relationships
    public function role(): BelongsTo;           // User belongs to Role
    public function peminjaman(): HasMany;        // User has many Peminjaman
    public function notifikasi(): HasMany;        // User has many Notifikasi
    public function logAktivitas(): HasMany;      // User has many LogAktivitas
    public function unreadNotifikasi(): HasMany;  // Filtered unread notifications
    
    // Helper methods
    public function isAdmin(): bool;              // Check if admin
    public function isPetugas(): bool;            // Check if petugas
    public function isPeminjam(): bool;           // Check if peminjam
}
```

### Alat Model

```php
// app/Models/Alat.php

class Alat extends Model
{
    // Relationships
    public function kategori(): BelongsTo;        // Alat belongs to Kategori
    public function peminjamanDetail(): HasMany;  // Alat has many PeminjamanDetail
    
    // Query Scopes
    public function scopeByKategori($query, $id); // Filter by kategori
    public function scopeSearch($query, $search); // Search by nama
    public function scopeTersedia($query);        // Filter stok > 0
}
```

### Peminjaman Model

```php
// app/Models/Peminjaman.php

class Peminjaman extends Model
{
    // Relationships
    public function user(): BelongsTo;            // Peminjaman by User
    public function detail(): HasMany;            // Peminjaman has many Detail
    public function pengembalian(): HasOne;       // Peminjaman has one Pengembalian
    public function approver(): BelongsTo;        // Approved by User
    public function returner(): BelongsTo;        // Returned by User
}
```

---

## Controllers

### Struktur Controller

Controller diorganisir berdasarkan role:

```
Controllers/
├── Admin/
│   ├── DashboardController.php   # Dashboard admin
│   ├── KategoriController.php    # CRUD kategori
│   ├── AlatController.php        # CRUD alat
│   ├── UserController.php        # CRUD user + approval
│   ├── DendaController.php       # CRUD denda
│   ├── HistoryController.php     # View history
│   └── LogController.php         # View log aktivitas
├── Petugas/
│   ├── DashboardController.php   # Dashboard petugas
│   ├── ApprovalController.php    # Approve/reject peminjaman
│   ├── PengembalianController.php # Proses pengembalian
│   ├── HistoryController.php     # View history
│   └── LaporanController.php     # Generate laporan
├── Peminjam/
│   ├── DashboardController.php   # Dashboard peminjam
│   ├── KatalogController.php     # View katalog alat
│   ├── CartController.php        # Keranjang & checkout
│   ├── PeminjamanController.php  # View riwayat
│   └── BookingController.php     # CRUD booking
├── NotifikasiController.php      # Notifikasi untuk semua role
└── ProfileController.php         # Edit profile user
```

### Contoh Controller Pattern

```php
// app/Http/Controllers/Admin/AlatController.php

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $alats = Alat::with('kategori')
            ->byKategori($request->kategori_id)
            ->search($request->search)
            ->orderBy($request->sort_by ?? 'id', $request->sort_direction ?? 'asc')
            ->paginate(10);
            
        return view('admin.alat.index', compact('alats'));
    }
    
    public function store(StoreAlatRequest $request)
    {
        // Validated data from Form Request
        $alat = Alat::create($request->validated());
        
        // Log aktivitas
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah alat: {$alat->nama_alat}",
        ]);
        
        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }
}
```

---

## Middleware

### RoleMiddleware

Memastikan user memiliki role yang sesuai:

```php
// app/Http/Middleware/RoleMiddleware.php

public function handle(Request $request, Closure $next, ...$roles): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $userRole = auth()->user()->role->nama_role;
    
    if (!in_array($userRole, $roles)) {
        abort(403, 'Unauthorized access');
    }
    
    return $next($request);
}
```

**Penggunaan di routes:**
```php
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Routes untuk admin
});
```

### StatusMiddleware

Memastikan user dalam status aktif:

```php
// app/Http/Middleware/StatusMiddleware.php

public function handle(Request $request, Closure $next): Response
{
    if (auth()->check() && auth()->user()->status !== 'active') {
        auth()->logout();
        return redirect()->route('login')
            ->with('error', 'Akun Anda tidak aktif');
    }
    
    return $next($request);
}
```

---

## Routes

### Struktur Routes

```php
// routes/web.php

// Public routes
Route::get('/', WelcomeController::class);

// Authenticated routes
Route::middleware(['auth', 'status'])->group(function () {
    // Profile (semua role)
    Route::get('/profile', [ProfileController::class, 'edit']);
    
    // Notifikasi (semua role)
    Route::resource('notifikasi', NotifikasiController::class);
    
    // Admin routes
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index']);
        Route::resource('kategori', Admin\KategoriController::class);
        Route::resource('alat', Admin\AlatController::class);
        Route::resource('user', Admin\UserController::class);
        // ... more routes
    });
    
    // Petugas routes
    Route::middleware('role:Petugas')->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/dashboard', [Petugas\DashboardController::class, 'index']);
        Route::resource('approval', Petugas\ApprovalController::class);
        // ... more routes
    });
    
    // Peminjam routes
    Route::middleware('role:Peminjam')->prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/dashboard', [Peminjam\DashboardController::class, 'index']);
        Route::resource('katalog', Peminjam\KatalogController::class);
        Route::resource('cart', Peminjam\CartController::class);
        // ... more routes
    });
});
```

---

## Views & Components

### Layout Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php         # Main layout (authenticated)
│   ├── guest.blade.php       # Guest layout (login/register)
│   ├── sidebar.blade.php     # Sidebar navigation
│   └── topbar.blade.php      # Top navigation bar
├── components/
│   ├── toast-notification.blade.php  # Toast/alert system
│   ├── modal.blade.php       # Modal dialog
│   ├── text-input.blade.php  # Form input component
│   └── ...
├── admin/                    # Admin views
├── petugas/                  # Petugas views
├── peminjam/                 # Peminjam views
└── profile/                  # Profile views
```

### Component Usage

**Toast Notification:**
```blade
{{-- Otomatis ditampilkan untuk session flash --}}
@if(session('success'))
    <script>Toast.success("{{ session('success') }}");</script>
@endif
```

**Confirm Dialog:**
```blade
{{-- Menggunakan data-confirm attribute --}}
<form method="POST" data-confirm="Yakin ingin menghapus?">
    <button type="submit">Hapus</button>
</form>
```

**Page Title:**
```blade
<x-app-layout>
    <x-slot name="pageTitle">Nama Halaman</x-slot>
    
    {{-- Content --}}
</x-app-layout>
```

---

## Authentication & Authorization

### Authentication Flow

1. User mengakses halaman protected
2. Middleware `auth` cek session
3. Jika tidak login, redirect ke `/login`
4. Setelah login, middleware `status` cek status user
5. Middleware `role` cek akses berdasarkan role

### Role-based Access Control

| Route Prefix | Role | Middleware |
|--------------|------|------------|
| /admin/* | Admin | auth, status, role:Admin |
| /petugas/* | Petugas | auth, status, role:Petugas |
| /peminjam/* | Peminjam | auth, status, role:Peminjam |

### Helper Methods

```php
// Di controller atau view
auth()->user()->isAdmin();     // true jika admin
auth()->user()->isPetugas();   // true jika petugas
auth()->user()->isPeminjam();  // true jika peminjam
```

---

## Seeder

### Available Seeders

| Seeder | Description | Command |
|--------|-------------|---------|
| DatabaseSeeder | Data dasar (default) | `php artisan db:seed` |
| AdminSeeder | Admin saja | `php artisan db:seed --class=AdminSeeder` |
| ComprehensiveSeeder | Data lengkap | `php artisan db:seed --class=ComprehensiveSeeder` |

### ComprehensiveSeeder Output

```
🚀 Memulai Comprehensive Seeder...
📝 Membuat Roles...
👥 Membuat Users...
📁 Membuat Kategori...
🔧 Membuat Alat...
💰 Membuat Tarif Denda...
📋 Membuat Peminjaman...
📅 Membuat Booking...
🔔 Membuat Notifikasi...
📝 Membuat Log Aktivitas...
✅ Comprehensive Seeder selesai!

📊 Ringkasan Data:
   - Roles: 3
   - Users: 50
   - Kategori: 8
   - Alat: 40
   - Denda: 5
   - Peminjaman: 120
   - Pengembalian: 60
   - Booking: 15
   - Notifikasi: 200
   - Log Aktivitas: 200
```

---

## Testing

### Test Structure

```
tests/
├── Feature/
│   ├── Auth/
│   │   ├── LoginTest.php
│   │   └── RegistrationTest.php
│   └── ...
└── Unit/
    └── ...
```

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=LoginTest

# Run with coverage
php artisan test --coverage
```

### Example Test

```php
// tests/Feature/Auth/LoginTest.php

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();
    
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    
    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard'));
});
```

---

## Best Practices

### Code Style
- Menggunakan PSR-12 coding standard
- Method naming: camelCase
- Variable naming: camelCase
- Class naming: PascalCase

### Security
- Semua input divalidasi via Form Request
- Password di-hash dengan bcrypt
- CSRF protection aktif
- XSS prevention via Blade escaping

### Performance
- Eager loading untuk menghindari N+1 query
- Pagination untuk data besar
- Cache untuk data yang jarang berubah

---

<p align="center">
  <em>Dokumentasi Teknis terakhir diperbarui: Februari 2026</em>
</p>
