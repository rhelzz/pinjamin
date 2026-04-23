<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">📚 Pinjamin - Sistem Manajemen Perpustakaan Terpadu</h1>

<p align="center">
  Aplikasi web untuk manajemen peminjaman buku dan koleksi perpustakaan berbasis Laravel 12 dengan fitur lengkap (Katalog, Keranjang, Booking, Denda, dan Laporan PDF).
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=flat-square&logo=tailwind-css" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=flat-square&logo=vite" alt="Vite">
  <img src="https://img.shields.io/badge/DomPDF-3.1-orange?style=flat-square&logo=pdf" alt="DomPDF">
</p>

---

## 📋 Daftar Isi

- [Tentang Aplikasi](#-tentang-aplikasi)
- [Arsitektur & Komponen Utama](#-arsitektur--komponen-utama)
- [Fitur Berdasarkan Role](#-fitur-berdasarkan-role)
- [Tampilan Aplikasi](#-tampilan-aplikasi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi Cepat](#-instalasi-cepat)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Data Seeder & Akun Default](#-data-seeder--akun-default)
- [Struktur Direktori Detail](#-struktur-direktori-detail)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Dokumentasi Lainnya](#-dokumentasi-lainnya)

---

## 📖 Tentang Aplikasi

**Pinjamin** adalah sistem manajemen peminjaman buku perpustakaan modern berbasis web yang dibangun dengan Laravel 12. Aplikasi ini mengelola siklus penuh operasional perpustakaan mulai dari pendaftaran anggota, katalog buku, keranjang peminjaman, sistem booking, persetujuan petugas, pengembalian, kalkulasi denda otomatis, hingga pembuatan laporan PDF.

---

## 🏗 Arsitektur & Komponen Utama

### 🗄️ Database Models (Eloquent)
Aplikasi ini memiliki relasi database yang kompleks menggunakan model berikut:
- `User` & `Role` - Manajemen pengguna dan hak akses (Admin, Petugas, Peminjam).
- `Buku` & `Genre` - Manajemen katalog pustaka dengan relasi Many-to-Many atau One-to-Many.
- `Peminjaman` & `PeminjamanDetail` - Mencatat transaksi utama peminjaman buku.
- `Pengembalian` - Mencatat data buku yang dikembalikan beserta kondisi buku.
- `Booking` - Sistem reservasi buku di muka.
- `Denda` - Sistem tarif dan catatan denda keterlambatan (mendukung per hari/per jam).
- `LogAktivitas` - Sistem audit trail yang mencatat semua tindakan admin/petugas.
- `Notifikasi` - Sistem notifikasi internal aplikasi untuk pengguna.

### 🎮 Controllers
Logika bisnis dipisah dengan rapi berdasarkan Role untuk keamanan (Namespace Separation):
- **Admin**: `BukuController`, `DendaController`, `GenreController`, `HistoryController`, `LogAktivitasController`, `UserController`.
- **Petugas**: `ApprovalController`, `HistoryController`, `LaporanController` (Cetak PDF), `PengembalianController`.
- **Peminjam**: `BookingController`, `CartController`, `KatalogController`, `PeminjamanController`.
- **General**: `DashboardController`, `NotifikasiController`, `ProfileController`.

---

## ✨ Fitur Berdasarkan Role

### 👑 1. Admin (Administrator Sistem)
- **Dashboard Analitik**: Statistik total buku, peminjaman aktif, total denda, dan pengguna.
- **Manajemen User**: Verifikasi, blokir (blacklist), edit dan hapus pengguna (Peminjam & Petugas).
- **Katalog Buku & Genre**: CRUD buku, upload cover, manajemen stok, dan kategori (Genre).
- **Pengaturan Denda**: Menetapkan aturan tarif denda dasar dan keterlambatan (tipe per jam/hari).
- **Log Aktivitas**: Pantauan sistem secara menyeluruh terhadap setiap aksi (Create, Update, Delete) yang dilakukan oleh user/petugas.
- **Riwayat Seluruh Transaksi**: Melihat semua riwayat peminjaman perpustakaan.

### 👨‍💼 2. Petugas (Operator Perpustakaan)
- **Approval Peminjaman**: Menerima atau menolak permintaan peminjaman dan booking dari anggota.
- **Proses Pengembalian**: Menangani pengembalian buku, mencatat tanggal kembali, dan memvalidasi kondisi buku.
- **Perhitungan Denda Otomatis**: Jika telat, sistem otomatis mengalkulasi denda, dan petugas mencatat pembayarannya.
- **Laporan PDF**: Generate dan unduh laporan transaksi peminjaman bulanan/harian dalam format PDF menggunakan `barryvdh/laravel-dompdf`.

### 🧑‍🎓 3. Peminjam (Anggota)
- **Katalog Digital**: Menelusuri ketersediaan buku, cover, sinopsis, dan genre secara real-time.
- **Keranjang (Cart)**: Menambahkan beberapa buku sekaligus ke dalam keranjang sebelum dipinjam.
- **Booking (Reservasi)**: Memesan buku yang sedang tidak tersedia (jika diaktifkan).
- **Riwayat Peminjaman**: Melihat status buku yang sedang dipinjam (Menunggu Persetujuan, Dipinjam, Selesai, Ditolak).
- **Notifikasi Terpadu**: Menerima peringatan ketika masa pinjam akan habis atau jika pinjaman disetujui/ditolak.

---

## 📸 Tampilan Aplikasi

### 🔐 Autentikasi & Profil
| Login | Register | Edit Profil |
|-------|----------|-------------|
| ![Login](dokumentasi_readme/Auth/Login.png) | ![Register](dokumentasi_readme/Auth/Register.png) | ![Profile](dokumentasi_readme/Global_UI/Profile_Edit.png) |

### 🧑‍🎓 Antarmuka Peminjam
| Dashboard | Katalog Buku | Keranjang |
|-----------|--------------|-----------|
| ![Dashboard Peminjam](dokumentasi_readme/Peminjam/Dashboard.png) | ![Katalog](dokumentasi_readme/Peminjam/Katalog.png) | ![Keranjang](dokumentasi_readme/Peminjam/Keranjang.png) |

| Booking | Riwayat Peminjaman | Notifikasi |
|---------|--------------------|------------|
| ![Booking](dokumentasi_readme/Peminjam/Booking.png) | ![Riwayat](dokumentasi_readme/Peminjam/Riwayat_Peminjaman.png) | ![Notifikasi](dokumentasi_readme/Peminjam/Notifikasi.png) |

### 👨‍💼 Antarmuka Petugas
| Dashboard | Persetujuan | Pengembalian |
|-----------|-------------|--------------|
| ![Dashboard Petugas](dokumentasi_readme/Petugas/Dashboard.png) | ![Persetujuan](dokumentasi_readme/Petugas/Persetujuan.png) | ![Pengembalian](dokumentasi_readme/Petugas/Pengembalian.png) |

| Laporan | Notifikasi |
|---------|------------|
| ![Laporan](dokumentasi_readme/Petugas/Laporan.png) | ![Notifikasi Petugas](dokumentasi_readme/Petugas/Notifikasi.png) |

### 👑 Antarmuka Admin
| Dashboard | Manajemen User | Approval User |
|-----------|----------------|---------------|
| ![Dashboard Admin](dokumentasi_readme/Admin/Dashboard.png) | ![User](dokumentasi_readme/Admin/Manajemen_User.png) | ![Approval](dokumentasi_readme/Admin/Approval_User.png) |

| Manajemen Buku | Manajemen Genre | Manajemen Denda |
|----------------|-----------------|-----------------|
| ![Buku](dokumentasi_readme/Admin/Manajemen_Buku.png) | ![Genre](dokumentasi_readme/Admin/Manajemen_Genre.png) | ![Denda](dokumentasi_readme/Admin/Manajemen_Denda.png) |

| Log Aktivitas | Peminjaman Global | Notifikasi |
|---------------|-------------------|------------|
| ![Log](dokumentasi_readme/Admin/Log_Aktivitas.png) | ![Global](dokumentasi_readme/Admin/Data_Peminjaman_Global.png) | ![Notifikasi Admin](dokumentasi_readme/Admin/Notifikasi.png) |

---

## 💻 Persyaratan Sistem

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & NPM >= 9.x
- **Database**: MySQL >= 8.x atau MariaDB >= 10.x
- **Ekstensi PHP**: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`, `GD` (untuk DomPDF).

---

## 🚀 Instalasi Cepat (Otomatis)

Project ini telah dikonfigurasi dengan script composer otomatis untuk kemudahan instalasi:

```bash
# 1. Clone Repository
git clone https://github.com/username/pinjamin.git
cd pinjamin

# 2. Setup Otomatis (Akan menginstall vendor PHP, NPM, generate key, dan migrate)
composer run setup
```
*(Pastikan Anda sudah mengedit file `.env` untuk kredensial database sebelum menjalankan migrate yang ada di dalam script setup jika tidak menggunakan SQLite).*

### Instalasi Manual (Alternatif)
Jika script setup di atas gagal, lakukan langkah berikut:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# Sesuaikan .env dengan database Anda
php artisan migrate
npm run build
php artisan storage:link
```

---

## ▶️ Menjalankan Aplikasi

Project ini memanfaatkan Laravel 12 dan Vite, serta menggunakan Queue. Gunakan perintah berikut untuk menjalankan Server, Queue, dan Vite sekaligus dalam satu terminal menggunakan *concurrently*:

```bash
composer run dev
```

Atau jalankan secara terpisah:
1. `php artisan serve` (Terminal 1)
2. `php artisan queue:listen` (Terminal 2)
3. `npm run dev` (Terminal 3)

Aplikasi dapat diakses di: **`http://localhost:8000`**

---

## 🌱 Data Seeder & Akun Default

Kami menyediakan `ComprehensiveSeeder` untuk mengisi database dengan ratusan data dummy realistis (Buku, User, Transaksi, Log).

```bash
php artisan migrate:fresh --seed --seeder=ComprehensiveSeeder
```

**Daftar Akun Default Login:**
*(Semua password default adalah: `password`)*

| Role | Username | Email |
|------|----------|-------|
| **Admin** | `admin` | `admin@pinjamin.test` |
| **Petugas** | `petugas` | `petugas@pinjamin.test` |
| **Peminjam** | `peminjam` | `peminjam@pinjamin.test` |

*(Jika memakai `ComprehensiveSeeder`, terdapat user tambahan seperti `budi.petugas`, `andi.wijaya`, dll.)*

---

## 📁 Struktur Direktori Detail

Aplikasi diorganisir sesuai best practice MVC Laravel:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/         # Controller spesifik hak akses Admin
│   │   ├── Peminjam/      # Controller operasional Anggota
│   │   └── Petugas/       # Controller operasional Petugas/Pustakawan
│   ├── Middleware/        # Cek Role (CheckBlacklist, RoleMiddleware)
│   └── Requests/          # Validasi Input Form (FormRequests)
├── Models/                # (Buku, Booking, Denda, Peminjaman, dll)
└── Providers/
resources/
├── views/
│   ├── admin/             # View UI Dashboard & Master Data Admin
│   ├── petugas/           # View UI Approval & Laporan
│   ├── peminjam/          # View UI Katalog, Cart, Booking
│   ├── components/        # Blade UI Components Tailwind (Buttons, Modals)
│   └── layouts/           # App, Guest, Navigation Layouts
routes/
├── web.php                # Rute dengan prefix '/admin', '/petugas', '/peminjam'
└── auth.php               # Rute Breeze Auth
database/
├── migrations/            # Skema DB berelasi penuh
└── seeders/               # File populasi data awal
```

---

## 🛠️ Teknologi yang Digunakan

- **Core Framework**: Laravel 12.0
- **Language**: PHP 8.2+
- **Frontend Toolkit**: TailwindCSS 4.0, Alpine.js 3.x, Vite 7.x
- **Authentication**: Laravel Breeze (Blade/Alpine)
- **PDF Generator**: `barryvdh/laravel-dompdf` (Versi 3.1)
- **Database**: MySQL / MariaDB (Dukungan penuh Relasi Eloquent)
- **Testing**: Pest PHP 4.3 (`pestphp/pest`)

---

## 📚 Dokumentasi Lainnya

- [📘 Dokumentasi Umum (Pengguna)](DOKUMENTASI.md) - Panduan cara pakai untuk awam.
- [📗 Dokumentasi Teknis (Developer)](DOKUMENTASI-TEKNIS.md) - Panduan kode, arsitektur, dan relasi DB.
- [📋 Testing Cases (UAT)](TESTING_CASES.md) - Skenario pengujian bug & fitur.

---

<p align="center">
  Dibuat untuk Manajemen Perpustakaan yang Lebih Baik. <br>
  <strong>&copy; 2026 Pinjamin Team</strong>
</p>
