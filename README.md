<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">📚 Pinjamin - Sistem Peminjaman Buku</h1>

<p align="center">
  Aplikasi web untuk manajemen peminjaman buku dan koleksi perpustakaan berbasis Laravel 12
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=flat-square&logo=tailwind-css" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=flat-square&logo=vite" alt="Vite">
</p>

---

## 📋 Daftar Isi

- [Tentang Aplikasi](#-tentang-aplikasi)
- [Fitur](#-fitur)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Menjalankan Seeder](#-menjalankan-seeder)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Default](#-akun-default)
- [Struktur Project](#-struktur-project)
- [Dokumentasi Lainnya](#-dokumentasi-lainnya)

---

## 📖 Tentang Aplikasi

**Pinjamin** adalah sistem manajemen peminjaman buku berbasis web yang dibangun dengan Laravel 12. Aplikasi ini dirancang untuk memudahkan pengelolaan koleksi buku dan proses peminjaman di lingkungan sekolah, perpustakaan, atau instansi lainnya.

## ✨ Fitur

### Fitur Umum
- 🔐 Autentikasi dengan Laravel Breeze
- 👥 Multi-role: Admin, Petugas, Peminjam
- 🔔 Sistem notifikasi real-time
- 🎨 UI Modern dengan TailwindCSS dan Glass Morphism
- 📱 Responsive design

### Fitur Admin
- 📊 Dashboard statistik
- 📁 Manajemen genre buku
- 📚 Manajemen data buku
- 👤 Manajemen user & persetujuan pendaftaran
- 💰 Pengaturan tarif denda
- 📜 Riwayat peminjaman
- 📝 Log aktivitas sistem

### Fitur Petugas
- ✅ Persetujuan peminjaman
- 📦 Proses pengembalian buku
- 📊 Laporan peminjaman
- 📜 Riwayat transaksi

### Fitur Peminjam
- 🔍 Katalog buku
- 🛒 Keranjang peminjaman
- 📅 Booking buku
- 📋 Riwayat peminjaman pribadi

---

## 💻 Persyaratan Sistem

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x
- NPM >= 9.x
- MySQL >= 8.x / MariaDB >= 10.x
- Git

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/pinjamin.git
cd pinjamin
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

## ⚙️ Konfigurasi

### 1. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pinjamin
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Buat Database

Buat database dengan nama yang sesuai (contoh: `pinjamin`) di MySQL/MariaDB.

### 3. Jalankan Migration

```bash
php artisan migrate
```

### 4. Buat Storage Link

```bash
php artisan storage:link
```

---

## 🌱 Menjalankan Seeder

### Opsi 1: Data Dasar (Recommended untuk Production)

Membuat data minimal: roles, 3 user demo, genre, buku, dan denda.

```bash
php artisan db:seed
```

### Opsi 2: Admin Saja

Hanya membuat roles dan 1 akun admin.

```bash
php artisan db:seed --class=AdminSeeder
```

### Opsi 3: Data Komprehensif (Recommended untuk Development/Testing)

Membuat data lengkap dan realistis:
- 3 Role
- 50+ Users (1 Admin, 3 Petugas, 46+ Peminjam)
- 8 Genre
- 40+ Buku
- 5 Tarif Denda
- 120+ Peminjaman dengan berbagai status
- Pengembalian, Booking, Notifikasi, Log Aktivitas

```bash
php artisan db:seed --class=ComprehensiveSeeder
```

### Fresh Migration dengan Seeder

Untuk reset database dan seed ulang:

```bash
# Dengan data dasar
php artisan migrate:fresh --seed

# Dengan data komprehensif
php artisan migrate:fresh --seed --seeder=ComprehensiveSeeder

# Dengan admin saja
php artisan migrate:fresh --seed --seeder=AdminSeeder
```

---

## ▶️ Menjalankan Aplikasi

### Development

Jalankan di dua terminal terpisah:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite (Hot Reload):**
```bash
npm run dev
```

Akses aplikasi di: `http://localhost:8000`

### Production

Build assets untuk production:

```bash
npm run build
```

---

## 🔑 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

| Role | Username | Email | Password |
|------|----------|-------|----------|
| Admin | `admin` | admin@pinjamin.test | password |
| Petugas | `petugas` | petugas@pinjamin.test | password |
| Peminjam | `peminjam` | peminjam@pinjamin.test | password |

> **Catatan:** Jika menggunakan `ComprehensiveSeeder`, tersedia lebih banyak akun dengan pola:
> - Petugas: `budi.petugas`, `siti.petugas`, `ahmad.petugas`
> - Peminjam: `andi.wijaya`, `dewi.lestari`, dll.
> - Semua password: `password`

---

## 📁 Struktur Project

```
pinjamin/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controller aplikasi
│   │   ├── Middleware/      # Middleware autentikasi & role
│   │   └── Requests/        # Form request validation
│   ├── Models/              # Eloquent models
│   ├── Providers/           # Service providers
│   └── View/Components/     # Blade components
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── css/                 # Stylesheet
│   ├── js/                  # JavaScript
│   └── views/               # Blade templates
│       ├── admin/           # Views untuk admin
│       ├── petugas/         # Views untuk petugas
│       ├── peminjam/        # Views untuk peminjam
│       ├── components/      # Reusable components
│       └── layouts/         # Layout templates
├── routes/
│   ├── web.php              # Web routes
│   └── auth.php             # Authentication routes
└── tests/                   # Test files (Pest PHP)
```

---

## 📚 Dokumentasi Lainnya

- [📘 Dokumentasi Umum](DOKUMENTASI.md) - Panduan penggunaan aplikasi
- [📗 Dokumentasi Teknis](DOKUMENTASI-TEKNIS.md) - Dokumentasi kode dan arsitektur
- [📋 Testing Cases (UAT)](TESTING_CASES.md) - Daftar skenario pengujian aplikasi

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 12.0, PHP 8.2+
- **Frontend:** Blade, TailwindCSS 4.0, Alpine.js 3.4
- **Database:** MySQL / MariaDB
- **Build Tool:** Vite 7.0
- **Authentication:** Laravel Breeze
- **Testing:** Pest PHP 4.3

---

## 📝 License

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center">
  Made with ❤️ using Laravel
</p>
