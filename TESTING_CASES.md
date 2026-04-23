# 📋 Test Case - Sistem Pinjamin

**Tanggal**: 23 April 2026  
**Versi Sistem**: 1.0  

---

## Daftar Isi
1. [Autentikasi & Profil (6 TC)](#autentikasi--profil)
2. [Manajemen Pengguna (5 TC)](#manajemen-pengguna)
3. [Manajemen Genre (4 TC)](#manajemen-genre)
4. [Manajemen Buku (5 TC)](#manajemen-buku)
5. [Manajemen Tarif Denda (4 TC)](#manajemen-tarif-denda)
6. [Katalog & Keranjang (5 TC)](#katalog--keranjang)
7. [Booking Buku (3 TC)](#booking-buku)
8. [Peminjaman (3 TC)](#peminjaman)
9. [Persetujuan Peminjaman (4 TC)](#persetujuan-peminjaman)
10. [Pengembalian (4 TC)](#pengembalian)
11. [Riwayat & Laporan (4 TC)](#riwayat--laporan)
12. [Notifikasi & Log Aktivitas (4 TC)](#notifikasi--log-aktivitas)
13. [Dashboard (3 TC)](#dashboard)

---

## AUTENTIKASI & PROFIL

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 1 | AUTH-001 | Autentikasi | Gagal - Akses Halaman Terproteksi | 1. Buka browser tanpa login<br>2. Coba akses URL `/admin/dashboard` secara manual | Pengguna dialihkan (redirect) ke halaman login | |
| 2 | AUTH-002 | Autentikasi | Gagal - Login (Kredensial Salah) | 1. Buka halaman login<br>2. Masukkan email/password yang salah<br>3. Klik login | Muncul pesan error "Kredensial tidak valid" | |
| 3 | AUTH-003 | Autentikasi | Sukses - Login | 1. Buka halaman login<br>2. Masukkan email dan password yang valid<br>3. Klik login | Berhasil masuk dan dialihkan ke dashboard sesuai role | |
| 4 | AUTH-004 | Autentikasi | Sukses - Logout | 1. Login ke aplikasi<br>2. Klik tombol profil<br>3. Klik "Logout" | Berhasil keluar dan dialihkan ke halaman login | |
| 5 | PROF-001 | Profil | Sukses - Edit Profil | 1. Buka halaman Profile<br>2. Ubah nama atau email<br>3. Simpan perubahan | Profil berhasil diperbarui | |
| 6 | PROF-002 | Profil | Sukses - Ubah Password | 1. Buka halaman Profile<br>2. Masukkan password lama dan baru<br>3. Simpan perubahan | Password berhasil diubah | |

---

## MANAJEMEN PENGGUNA

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 7 | USER-001 | Kelola Pengguna | Sukses - Lihat Daftar Pengguna | 1. Login sebagai Admin<br>2. Akses halaman `/admin/user` | Daftar pengguna dengan status dan rolenya tampil | |
| 8 | USER-002 | Kelola Pengguna | Sukses - Tambah Pengguna | 1. Di halaman user, klik "Tambah"<br>2. Isi form lengkap<br>3. Simpan | Pengguna baru berhasil ditambahkan | |
| 9 | USER-003 | Kelola Pengguna | Gagal - Email/Username Duplikat | 1. Tambah pengguna<br>2. Gunakan email/username yang sudah terdaftar<br>3. Simpan | Muncul validasi error | |
| 10 | USER-004 | Kelola Pengguna | Sukses - Edit Data Pengguna | 1. Pilih salah satu user, klik Edit<br>2. Ubah data<br>3. Simpan | Data pengguna berhasil diubah | |
| 11 | USER-005 | Kelola Pengguna | Sukses - Ubah Status (Blacklist) | 1. Pilih user, ubah status menjadi `blacklist`<br>2. Coba login dengan user tersebut | Status berubah dan user tersebut ditolak saat mencoba masuk | |

---

## MANAJEMEN GENRE

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 12 | GNR-001 | Genre | Sukses - Lihat Daftar Genre | 1. Login sebagai Admin<br>2. Akses halaman `/admin/genre` | Daftar genre tampil | |
| 13 | GNR-002 | Genre | Sukses - Tambah Genre | 1. Klik Tambah Genre<br>2. Isi nama genre<br>3. Simpan | Genre baru berhasil ditambahkan | |
| 14 | GNR-003 | Genre | Gagal - Tambah Nama Duplikat | 1. Tambah genre dengan nama yang sama persis dengan yang ada<br>2. Simpan | Muncul validasi error | |
| 15 | GNR-004 | Genre | Sukses - Edit/Hapus Genre | 1. Pilih genre, lakukan Edit / Hapus | Genre terupdate / terhapus | |

---

## MANAJEMEN BUKU

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 16 | BKU-001 | Buku | Sukses - Lihat Daftar Buku | 1. Login sebagai Admin<br>2. Akses halaman `/admin/buku` | Daftar buku dan stoknya tampil | |
| 17 | BKU-002 | Buku | Sukses - Tambah Buku | 1. Klik Tambah Buku<br>2. Isi form buku lengkap beserta genre dan gambar<br>3. Simpan | Buku berhasil ditambahkan dan stok tercatat | |
| 18 | BKU-003 | Buku | Gagal - Tambah Stok Negatif | 1. Tambah/Edit buku<br>2. Isi stok dengan angka -1<br>3. Simpan | Muncul validasi error stok tidak valid | |
| 19 | BKU-004 | Buku | Sukses - Edit Buku | 1. Pilih buku, ubah data (misal: tambah stok)<br>2. Simpan | Data buku berhasil diubah | |
| 20 | BKU-005 | Buku | Sukses - Hapus Buku | 1. Pilih buku, klik Hapus<br>2. Konfirmasi | Buku terhapus dari sistem | |

---

## MANAJEMEN TARIF DENDA

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 21 | TRF-001 | Tarif Denda | Sukses - Lihat Tarif Denda | 1. Login sebagai Admin<br>2. Akses halaman `/admin/denda` | Daftar tarif denda tampil | |
| 22 | TRF-002 | Tarif Denda | Sukses - Tambah Tarif Baru | 1. Klik Tambah Tarif<br>2. Isi nama, nominal, dan tipe denda<br>3. Simpan | Tarif denda berhasil tersimpan | |
| 23 | TRF-003 | Tarif Denda | Sukses - Edit Tarif Denda | 1. Pilih tarif denda, ubah nominal<br>2. Simpan | Tarif denda berhasil diubah | |
| 24 | TRF-004 | Tarif Denda | Sukses - Nonaktifkan Tarif | 1. Pilih tarif, ubah status aktif menjadi nonaktif | Tarif tidak dapat digunakan untuk pengembalian baru | |

---

## KATALOG & KERANJANG

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 25 | KTLG-001 | Katalog | Sukses - Lihat & Filter | 1. Login sebagai Peminjam<br>2. Akses katalog<br>3. Coba search / filter berdasarkan genre | Daftar buku tampil sesuai kriteria pencarian | |
| 26 | CART-001 | Keranjang | Sukses - Tambah ke Keranjang | 1. Di halaman katalog, pilih buku<br>2. Isi jumlah, klik Tambah ke Keranjang | Buku masuk ke keranjang, muncul notifikasi sukses | |
| 27 | CART-002 | Keranjang | Gagal - Melebihi Stok | 1. Tambah buku ke keranjang melebihi stok yang ada | Muncul pesan error/validasi stok tidak cukup | |
| 28 | CART-003 | Keranjang | Sukses - Edit/Hapus dari Keranjang | 1. Buka Keranjang<br>2. Ubah jumlah item atau hapus item | Keranjang terupdate dengan benar | |
| 29 | CART-004 | Keranjang | Sukses - Checkout (Peminjaman) | 1. Buka Keranjang<br>2. Tentukan tanggal pengembalian<br>3. Klik Checkout | Peminjaman berhasil dibuat dengan status `Pending` | |

---

## BOOKING BUKU

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 30 | BKG-001 | Booking | Sukses - Buat Booking Baru | 1. Login sebagai Peminjam<br>2. Pilih buku, klik Booking<br>3. Isi jumlah dan tanggal<br>4. Simpan | Booking tercatat dengan status `Menunggu` | |
| 31 | BKG-002 | Booking | Gagal - Double Booking | 1. Coba booking ulang buku yang sama yang masih berstatus `Menunggu` | Muncul peringatan sudah ada booking yang aktif | |
| 32 | BKG-003 | Booking | Sukses - Batalkan Booking | 1. Buka halaman Booking<br>2. Pilih booking status `Menunggu`<br>3. Klik Batal | Booking berhasil dibatalkan | |

---

## PEMINJAMAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 33 | PMJ-001 | Peminjaman | Sukses - Lihat Riwayat | 1. Login sebagai Peminjam<br>2. Buka halaman Peminjaman | Menampilkan daftar peminjaman pribadi | |
| 34 | PMJ-002 | Peminjaman | Sukses - Status Pending | 1. Setelah checkout dari cart, cek status peminjaman | Status tercatat `Pending` | |
| 35 | PMJ-003 | Peminjaman | Sukses - Status Dipinjam | 1. Petugas menyetujui peminjaman<br>2. Cek status di sisi peminjam | Status berubah menjadi `Dipinjam` | |

---

## PERSETUJUAN PEMINJAMAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 36 | APV-001 | Persetujuan | Sukses - Lihat Daftar Pending | 1. Login sebagai Petugas<br>2. Buka halaman `/petugas/approval` | Menampilkan peminjaman yang menunggu persetujuan | |
| 37 | APV-002 | Persetujuan | Sukses - Setujui Peminjaman | 1. Pilih peminjaman berstatus `Pending`<br>2. Klik Setujui | Status berubah jadi `Dipinjam`, stok buku berkurang | |
| 38 | APV-003 | Persetujuan | Gagal - Setujui (Stok Habis) | 1. Coba setujui peminjaman saat stok buku tersebut 0 | Muncul error bahwa stok tidak mencukupi | |
| 39 | APV-004 | Persetujuan | Sukses - Tolak Peminjaman | 1. Pilih peminjaman `Pending`<br>2. Klik Tolak, isi alasan penolakan<br>3. Konfirmasi | Status berubah jadi `Ditolak` dan alasan tercatat | |

---

## PENGEMBALIAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 40 | PGB-001 | Pengembalian | Sukses - Lihat Daftar Pengembalian | 1. Login sebagai Petugas<br>2. Buka halaman `/petugas/pengembalian` | Menampilkan peminjaman berstatus `Dipinjam` | |
| 41 | PGB-002 | Pengembalian | Sukses - Pengembalian Normal | 1. Pilih peminjaman<br>2. Tandai kondisi buku Baik<br>3. Proses pengembalian | Status jadi `Selesai` dan stok buku bertambah kembali | |
| 42 | PGB-003 | Pengembalian | Sukses - Pengembalian dgn Denda | 1. Pilih peminjaman yang telat kembali / kondisi rusak/hilang<br>2. Pilih tarif denda yg sesuai<br>3. Proses pengembalian | Denda dihitung dan masuk rekap pengembalian | |
| 43 | PGB-004 | Pengembalian | Sukses - Cetak Struk Denda | 1. Buka detail pengembalian yang ada denda<br>2. Klik cetak/detail | Detail denda dapat ditampilkan / dicetak dengan benar | |

---

## RIWAYAT & LAPORAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 44 | HIS-001 | Riwayat | Sukses - Lihat History | 1. Login Admin/Petugas<br>2. Buka Riwayat Peminjaman | Menampilkan semua riwayat dari seluruh peminjam | |
| 45 | LAP-001 | Laporan | Sukses - Lihat Laporan Peminjaman | 1. Login sebagai Petugas<br>2. Buka Laporan<br>3. Filter tanggal | Rekap total peminjaman sesuai filter tampil | |
| 46 | LAP-002 | Laporan | Sukses - Laporan Denda | 1. Buka Laporan Denda<br>2. Filter tanggal | Menampilkan total rekap nominal denda yang masuk | |
| 47 | LAP-003 | Laporan | Sukses - Download PDF/Excel | 1. Di halaman laporan, klik tombol Export / Print | File hasil ekspor berhasil diunduh dengan data yg benar | |

---

## NOTIFIKASI & LOG AKTIVITAS

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 48 | NTF-001 | Notifikasi | Sukses - Terima Notifikasi Approval | 1. Petugas menyetujui peminjaman<br>2. Peminjam mengecek ikon lonceng | Peminjam mendapat notifikasi peminjaman disetujui | |
| 49 | NTF-002 | Notifikasi | Sukses - Tandai Sudah Dibaca | 1. Klik notifikasi baru | Status notifikasi berubah menjadi sudah dibaca | |
| 50 | LOG-001 | Log Aktivitas | Sukses - Rekam Aktivitas | 1. Lakukan aksi CRUD (contoh: tambah buku)<br>2. Login Admin, cek Log Aktivitas | Aktivitas penambahan buku tercatat di Log | |
| 51 | LOG-002 | Log Aktivitas | Sukses - Tampil Info Lengkap Log | 1. Buka Log Aktivitas di Admin | Menampilkan user pelaksana, deskripsi aktivitas, dan tanggal | |

---

## DASHBOARD

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|----------------------|---------------------------|
| 52 | DSH-001 | Dashboard | Sukses - Admin Dashboard | 1. Login Admin<br>2. Lihat Dashboard | Statistik (Total User, Total Buku, Aktivitas terbaru) tampil dengan akurat | |
| 53 | DSH-002 | Dashboard | Sukses - Petugas Dashboard | 1. Login Petugas<br>2. Lihat Dashboard | Statistik (Pending Approval, Buku Dipinjam) tampil akurat | |
| 54 | DSH-003 | Dashboard | Sukses - Peminjam Dashboard | 1. Login Peminjam<br>2. Lihat Dashboard | Menampilkan jumlah peminjaman aktif, history pribadi, dll. | |

---

## RINGKASAN

**Total Test Cases: 54**

| Modul | Jumlah TC | Status |
|-------|-----------|--------|
| Autentikasi & Profil | 6 | - |
| Manajemen Pengguna | 5 | - |
| Manajemen Genre | 4 | - |
| Manajemen Buku | 5 | - |
| Manajemen Tarif Denda | 4 | - |
| Katalog & Keranjang | 5 | - |
| Booking Buku | 3 | - |
| Peminjaman | 3 | - |
| Persetujuan Peminjaman | 4 | - |
| Pengembalian | 4 | - |
| Riwayat & Laporan | 4 | - |
| Notifikasi & Log Aktivitas | 4 | - |
| Dashboard | 3 | - |
| **TOTAL** | **54** | - |

---

**Catatan:**
- Format testing mengikuti standar dokumentasi pengujian sistem informasi.
- Setiap test case dirancang untuk menguji fungsionalitas spesifik berdasarkan role.
- Kolom "Hasil Aktual (Lulus/Gagal)" diisi secara manual saat menjalankan simulasi UAT.
