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
| Backend | Laravel 13.*, PHP 8.4+ |
| Frontend | Blade, TailwindCSS 4.*, Alpine.js 3.4 |
| Database | MySQL 8.* / MariaDB 10 |
| Build Tool | Vite 7.0 |
| Authentication | Laravel Breeze |
| Testing | Pest PHP 4.3 |

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
│   │   │   ├── BukuController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DendaController.php
│   │   │   ├── HistoryController.php
│   │   │   ├── GenreController.php
│   │   │   ├── LogAktivitasController.php
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
│   │   └── CheckBlacklist.php       # Cek status blacklist
│   └── Requests/            # Form Request Validation
├── Models/
│   ├── Booking.php
│   ├── Buku.php
│   ├── Denda.php
│   ├── Genre.php
│   ├── LogAktivitas.php
│   ├── Notifikasi.php
│   ├── Peminjaman.php
│   ├── PeminjamanDetail.php
│   ├── Pengembalian.php
│   ├── Role.php
│   └── User.php
└── View/
    └── Components/
        ├── AppLayout.php
        └── GuestLayout.php
```

---

## Struktur Database

### Entity Relationship Diagram

```
┌─────────────┐       ┌─────────────┐
│    Role     │       │    Genre    │
├─────────────┤       ├─────────────┤
│ id          │       │ id          │
│ nama_role   │       │ nama_genre  │
└──────┬──────┘       └──────┬──────┘
       │                     │
       │ 1                   │ 1
       │                     │
       │ *                   │ *
┌──────┴──────┐       ┌──────┴──────┐
│    User     │       │    Buku     │
├─────────────┤       ├─────────────┤
│ id          │       │ id          │
│ name        │       │ judul_buku  │
│ username    │       │ genre_id    │──FK
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
│ tanggal_kembali     │ buku_id     │──FK
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

#### 3. Genre
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| nama_genre | string | Nama genre |
| timestamps | - | created_at, updated_at |

#### 4. Buku
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| judul_buku | string | Judul buku |
| genre_id | bigint | FK ke genre |
| stok | integer | Jumlah stok tersedia |
| gambar | string | Path gambar (nullable) |
| deskripsi | text | Deskripsi buku (nullable) |
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
| buku_id | bigint | FK ke buku |
| jumlah | integer | Jumlah buku dipinjam |
| timestamps | - | created_at, updated_at |

#### 7. Pengembalian
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| peminjaman_id | bigint | FK ke peminjaman |
| tanggal_dikembalikan | date | Tanggal dikembalikan |
| denda | decimal(12,2) | Total denda |
| kondisi | enum | Baik/Rusak/Hilang |
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
| buku_id | bigint | FK ke buku |
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

### Buku Model

```php
// app/Models/Buku.php

class Buku extends Model
{
    // Relationships
    public function genre(): BelongsTo;           // Buku belongs to Genre
    public function peminjamanDetail(): HasMany;  // Buku has many PeminjamanDetail
    
    // Query Scopes
    public function scopeByGenre($query, $id);    // Filter by genre
    public function scopeSearch($query, $search); // Search by judul_buku
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
│   ├── GenreController.php       # CRUD genre
│   ├── BukuController.php        # CRUD buku
│   ├── UserController.php        # CRUD user + approval
│   ├── DendaController.php       # CRUD denda
│   ├── HistoryController.php     # View history
│   └── LogAktivitasController.php# View log aktivitas
├── Petugas/
│   ├── DashboardController.php   # Dashboard petugas
│   ├── ApprovalController.php    # Approve/reject peminjaman
│   ├── PengembalianController.php # Proses pengembalian
│   ├── HistoryController.php     # View history
│   └── LaporanController.php     # Generate laporan
├── Peminjam/
│   ├── DashboardController.php   # Dashboard peminjam
│   ├── KatalogController.php     # View katalog buku
│   ├── CartController.php        # Keranjang & checkout
│   ├── PeminjamanController.php  # View riwayat
│   └── BookingController.php     # CRUD booking
├── NotifikasiController.php      # Notifikasi untuk semua role
└── ProfileController.php         # Edit profile user
```

### Contoh Controller Pattern

```php
// app/Http/Controllers/Admin/BukuController.php

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $bukus = Buku::with('genre')
            ->when($request->genre_id, fn($q, $genre_id) => $q->where('genre_id', $genre_id))
            ->when($request->search, fn($q, $search) => $q->where('judul_buku', 'like', "%{$search}%"))
            ->orderBy($request->sort_by ?? 'id', $request->sort_direction ?? 'asc')
            ->paginate(10);
            
        return view('admin.buku.index', compact('bukus'));
    }
    
    public function store(StoreBukuRequest $request)
    {
        // Validated data from Form Request
        $buku = Buku::create($request->validated());
        
        // Log aktivitas
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Menambah buku: {$buku->judul_buku}",
        ]);
        
        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }
}
```

---

## Middleware

### RoleMiddleware

Memastikan user memiliki role yang sesuai:

```php
// app/Http/Middleware/RoleMiddleware.php

public function handle(Request $request, Closure $next, string $role): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $userRole = auth()->user()->role->nama_role;
    
    if (strtolower($userRole) !== strtolower($role)) {
        abort(403, 'Unauthorized access');
    }
    
    return $next($request);
}
```

**Penggunaan di routes:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes untuk admin
});
```

### CheckBlacklist

Memastikan user tidak dalam daftar blacklist:

```php
// app/Http/Middleware/CheckBlacklist.php

public function handle(Request $request, Closure $next): Response
{
    if (auth()->check() && auth()->user()->status === 'blacklist') {
        auth()->logout();
        return redirect()->route('login')
            ->with('error', 'Akun Anda telah dinonaktifkan.');
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
Route::get('/', function () { return redirect()->route('login'); });

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit']);
    
    // Notifikasi
    Route::prefix('notifikasi')->group(function () { /* ... */ });
    
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('genre', Admin\GenreController::class);
        Route::resource('buku', Admin\BukuController::class);
        Route::resource('user', Admin\UserController::class);
        // ... more routes
    });
    
    // Petugas routes
    Route::middleware('role:petugas')->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/approval', [Petugas\ApprovalController::class, 'index']);
        // ... more routes
    });
    
    // Peminjam routes
    Route::middleware('role:peminjam')->prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/katalog', [Peminjam\KatalogController::class, 'index']);
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
{{-- Menggunakan x-data dari alpine --}}
<button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')">Hapus</button>
```

---

## Authentication & Authorization

### Authentication Flow

1. User mengakses halaman protected
2. Middleware `auth` cek session
3. Jika tidak login, redirect ke `/login`
4. Setelah login, middleware `CheckBlacklist` cek status user
5. Middleware `role` cek akses berdasarkan role

### Role-based Access Control

| Route Prefix | Role | Middleware |
|--------------|------|------------|
| /admin/* | Admin | auth, CheckBlacklist, role:admin |
| /petugas/* | Petugas | auth, CheckBlacklist, role:petugas |
| /peminjam/* | Peminjam | auth, CheckBlacklist, role:peminjam |

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
📁 Membuat Genre...
🔧 Membuat Buku...
💰 Membuat Tarif Denda...
📋 Membuat Peminjaman...
📅 Membuat Booking...
🔔 Membuat Notifikasi...
📝 Membuat Log Aktivitas...
✅ Comprehensive Seeder selesai!

📊 Ringkasan Data:
   - Roles: 3
   - Users: 50
   - Genre: 8
   - Buku: 40
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

### Running Tests (Pest PHP 4.3)

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
