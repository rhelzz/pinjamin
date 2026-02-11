# 📘 Dokumentasi Umum - Pinjamin

Panduan lengkap penggunaan aplikasi Pinjamin - Sistem Peminjaman Alat.

---

## 📋 Daftar Isi

- [Pengantar](#pengantar)
- [Peran Pengguna](#peran-pengguna)
- [Panduan Admin](#panduan-admin)
- [Panduan Petugas](#panduan-petugas)
- [Panduan Peminjam](#panduan-peminjam)
- [Fitur Umum](#fitur-umum)
- [FAQ](#faq)

---

## Pengantar

**Pinjamin** adalah aplikasi web untuk mengelola peminjaman alat/inventaris. Aplikasi ini memiliki tiga peran pengguna dengan hak akses yang berbeda-beda.

### Alur Peminjaman

```
┌─────────────┐     ┌──────────────┐     ┌───────────────┐     ┌─────────────┐
│  Peminjam   │────▶│   Pending    │────▶│   Dipinjam    │────▶│   Selesai   │
│  Checkout   │     │  (Menunggu)  │     │  (Disetujui)  │     │ (Kembali)   │
└─────────────┘     └──────────────┘     └───────────────┘     └─────────────┘
                           │                                          ▲
                           │                                          │
                           ▼                                          │
                    ┌──────────────┐                           ┌──────────────┐
                    │   Ditolak    │                           │ Pengembalian │
                    └──────────────┘                           │   Petugas    │
                                                               └──────────────┘
```

---

## Peran Pengguna

### 1. Admin
Admin memiliki akses penuh ke sistem dengan kemampuan:
- Mengelola seluruh data master (kategori, alat, user, denda)
- Menyetujui pendaftaran user baru
- Melihat log aktivitas sistem
- Melihat semua riwayat peminjaman

### 2. Petugas
Petugas bertanggung jawab untuk operasional peminjaman:
- Menyetujui atau menolak permintaan peminjaman
- Memproses pengembalian alat
- Membuat laporan peminjaman
- Melihat riwayat transaksi

### 3. Peminjam
Peminjam adalah end-user yang akan meminjam alat:
- Melihat katalog alat
- Menambahkan alat ke keranjang
- Melakukan checkout peminjaman
- Melakukan booking untuk alat yang sedang dipinjam
- Melihat riwayat peminjaman pribadi

---

## Panduan Admin

### Dashboard
Dashboard admin menampilkan statistik keseluruhan sistem:
- Total alat, kategori, dan user
- Statistik peminjaman (pending, dipinjam, selesai)
- Grafik aktivitas peminjaman

### Manajemen Kategori
1. Navigasi ke **Kategori** di sidebar
2. Klik **Tambah Kategori** untuk menambah kategori baru
3. Klik ikon **Edit** untuk mengubah nama kategori
4. Klik ikon **Hapus** untuk menghapus kategori

> **Catatan:** Menghapus kategori akan menyebabkan alat dalam kategori tersebut kehilangan kategorinya.

### Manajemen Alat
1. Navigasi ke **Data Alat** di sidebar
2. Klik **Tambah Alat** untuk menambah alat baru
3. Isi informasi alat:
   - Nama Alat (wajib)
   - Kategori (wajib)
   - Stok (wajib)
   - Gambar (opsional)
   - Deskripsi (opsional)
4. Klik **Simpan**

### Manajemen User
1. Navigasi ke **Manajemen User** di sidebar
2. Untuk menambah user: Klik **Tambah User**
3. Untuk mengedit: Klik ikon **Edit** pada baris user
4. Untuk menghapus: Klik ikon **Hapus**

### Persetujuan User Baru
1. Navigasi ke **Persetujuan User** di sidebar
2. Review data pendaftar
3. Klik **Setujui** untuk mengaktifkan akun
4. Klik **Tolak** dengan memberikan alasan jika ditolak

### Tarif Denda
1. Navigasi ke **Tarif Denda** di sidebar
2. Tersedia 3 tipe denda:
   - **Per Jam:** Denda dihitung berdasarkan jam keterlambatan
   - **Per Hari:** Denda dihitung berdasarkan hari keterlambatan
   - **Tetap:** Denda dengan nominal tetap (untuk kerusakan)
3. Aktifkan/nonaktifkan denda sesuai kebutuhan

### History Peminjaman
1. Navigasi ke **History Peminjaman** di sidebar
2. Filter berdasarkan status, periode, atau pencarian
3. Klik detail untuk melihat informasi lengkap

### Log Aktivitas
1. Navigasi ke **Log Aktivitas** di sidebar
2. Lihat semua aktivitas yang dilakukan user di sistem
3. Filter berdasarkan user atau periode waktu

---

## Panduan Petugas

### Dashboard
Dashboard petugas menampilkan:
- Jumlah peminjaman pending yang perlu disetujui
- Jumlah alat yang sedang dipinjam
- Statistik pengembalian hari ini

### Persetujuan Peminjaman
1. Navigasi ke **Persetujuan** di sidebar
2. Lihat daftar peminjaman dengan status **Pending**
3. Klik **Detail** untuk melihat informasi lengkap
4. Pilih **Setujui** atau **Tolak** (dengan alasan)

### Proses Pengembalian
1. Navigasi ke **Pengembalian** di sidebar
2. Cari peminjaman yang akan dikembalikan
3. Klik **Proses Pengembalian**
4. Isi form pengembalian:
   - Kondisi alat (Baik/Rusak)
   - Pilih tarif denda jika ada keterlambatan/kerusakan
   - Catatan (opsional)
5. Klik **Proses Pengembalian**

### Laporan
1. Navigasi ke **Laporan** di sidebar
2. Pilih periode laporan (mingguan/bulanan/custom)
3. Lihat statistik dan grafik peminjaman
4. Export ke PDF jika diperlukan

---

## Panduan Peminjam

### Katalog Alat
1. Navigasi ke **Katalog Alat** di sidebar
2. Browse alat yang tersedia
3. Gunakan filter kategori atau pencarian
4. Klik **Detail** untuk melihat informasi lengkap alat

### Menambah ke Keranjang
1. Pada halaman katalog atau detail alat
2. Pilih jumlah yang ingin dipinjam
3. Klik **Tambah ke Keranjang**
4. Alat akan masuk ke keranjang

### Checkout Peminjaman
1. Klik menu **Keranjang** di sidebar
2. Review item dalam keranjang
3. Atur jumlah atau hapus item jika perlu
4. Pilih **Tanggal Kembali**
5. Klik **Checkout**
6. Peminjaman akan masuk status **Pending**

### Booking Alat
Jika alat yang diinginkan sedang dipinjam:
1. Pada halaman katalog, cari alat yang stoknya 0
2. Klik **Booking**
3. Pilih tanggal booking (setelah perkiraan kembali)
4. Pilih tanggal pengembalian
5. Klik **Buat Booking**

### Melihat Status Peminjaman
1. Navigasi ke **Riwayat Peminjaman** di sidebar
2. Lihat status setiap peminjaman:
   - **Pending:** Menunggu persetujuan
   - **Dipinjam:** Sudah disetujui, alat dalam peminjaman
   - **Ditolak:** Ditolak oleh petugas
   - **Selesai:** Sudah dikembalikan

---

## Fitur Umum

### Notifikasi
- Notifikasi muncul di topbar (ikon lonceng)
- Klik untuk melihat semua notifikasi
- Tandai sebagai dibaca atau hapus notifikasi

### Profile
1. Klik nama/avatar di topbar
2. Pilih **Profile**
3. Tersedia 3 section:
   - **Informasi Profile:** Ubah nama dan email
   - **Ubah Password:** Ganti password
   - **Hapus Akun:** Hapus akun permanen

### Alert/Toast
Sistem menggunakan toast notification untuk feedback:
- **Hijau:** Sukses
- **Merah:** Error
- **Kuning:** Warning
- **Biru:** Info

---

## FAQ

### Q: Bagaimana cara mendaftar sebagai peminjam?
A: Kunjungi halaman Register, isi form pendaftaran, lalu tunggu persetujuan dari Admin.

### Q: Berapa lama peminjaman bisa dilakukan?
A: Tergantung kebijakan instansi, biasanya 1-7 hari.

### Q: Apa yang terjadi jika terlambat mengembalikan?
A: Akan dikenakan denda sesuai tarif yang berlaku (per jam/per hari).

### Q: Bagaimana jika alat rusak saat dipinjam?
A: Laporkan ke petugas, akan dikenakan denda kerusakan sesuai tingkat kerusakan.

### Q: Bisakah membooking alat yang sedang dipinjam?
A: Ya, gunakan fitur Booking untuk mereservasi alat yang sedang dipinjam orang lain.

### Q: Bagaimana cara melihat riwayat peminjaman?
A: Navigasi ke menu **Riwayat Peminjaman** di sidebar.

---

## Dukungan

Jika mengalami kendala atau memiliki pertanyaan, silakan hubungi:
- Email: support@pinjamin.test
- WhatsApp: +62xxx-xxxx-xxxx

---

<p align="center">
  <em>Dokumentasi ini terakhir diperbarui: Februari 2026</em>
</p>
