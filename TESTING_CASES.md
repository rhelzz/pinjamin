# 📋 Test Case - Sistem Pinjamin

**Tanggal**: 11 Februari 2026  
**Versi Sistem**: 1.0  
**Total Test Cases**: 64

---

## Daftar Isi
1. [Autentikasi (5 TC)](#autentikasi)
2. [Manajemen Pengguna (6 TC)](#manajemen-pengguna)
3. [Manajemen Genre (5 TC)](#manajemen-genre)
4. [Manajemen Buku (5 TC)](#manajemen-buku)
5. [Katalog & Cart (5 TC)](#katalog--cart)
6. [Peminjaman (10 TC)](#peminjaman)
7. [Persetujuan Peminjaman (5 TC)](#persetujuan-peminjaman)
8. [Pengembalian (5 TC)](#pengembalian)
9. [Denda (6 TC)](#denda)
10. [Laporan (4 TC)](#laporan)
11. [Notifikasi (3 TC)](#notifikasi)
12. [Log Aktivitas (2 TC)](#log-aktivitas)
13. [Dashboard (2 TC)](#dashboard)

---

## AUTENTIKASI

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 1 | AUTH-001 | Autentikasi | Gagal - Akses Halaman Terproteksi | 1. Logout.<br>2. Coba akses URL /admin secara manual. | - | Pengguna dialihkan (redirect) ke halaman /auth/login | |
| 2 | AUTH-002 | Autentikasi | Gagal - Login (Password Salah) | 1. Buka /auth/login<br>2. Masukkan username yang benar<br>3. Masukkan password yang salah | Username: admin<br>Password: SalahPassword | Login gagal, muncul pesan "Username atau password salah" | |
| 3 | AUTH-003 | Autentikasi | Sukses - Login Admin | 1. Buka /auth/login<br>2. Masukkan username dan password yang benar<br>3. Klik tombol masuk | Username: admin<br>Password: Admin123 | Login berhasil, pengguna dialihkan ke /admin/dashboard | |
| 4 | AUTH-004 | Autentikasi | Sukses - Logout | 1. Login dengan kredensial yang valid<br>2. Navigasi ke halaman manapun<br>3. Klik tombol logout di header<br>4. Konfirmasi logout | - | Logout berhasil, pengguna dialihkan ke halaman /auth/login | |
| 5 | AUTH-005 | Autentikasi | Gagal - Akun Tidak Aktif/Diblokir | 1. Buka /auth/login<br>2. Masukkan username dan password akun yang statusnya TIDAK AKTIF<br>3. Klik tombol masuk | Username: peminjam_inactive<br>Password: Password123 | Menampilkan pesan "Akun Anda tidak aktif. Hubungi administrator" | |

---

## MANAJEMEN PENGGUNA

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 6 | USER-001 | Kelola Pengguna | Sukses - Lihat Daftar Semua Pengguna | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Tunggu data dimuat | Username: admin<br>Password: Admin123 | Daftar lengkap pengguna tampil dengan informasi nama, username, role, status | |
| 7 | USER-002 | Kelola Pengguna | Sukses - Tambah Pengguna Baru | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Klik tombol "Tambah Pengguna"<br>4. Isi form: nama, username, password, role<br>5. Klik tombol "Simpan" | Nama: Budi Santoso<br>Username: busan<br>Password: BudiPass123<br>Role: Peminjam | Pengguna baru berhasil ditambahkan dan muncul di daftar | |
| 8 | USER-003 | Kelola Pengguna | Gagal - Tambah Pengguna dengan Username Duplikat | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Klik tombol "Tambah Pengguna"<br>4. Isi form dengan username yang sudah ada<br>5. Klik tombol "Simpan" | Username: admin (sudah ada) | Muncul pesan validasi "Username sudah terdaftar" | |
| 9 | USER-004 | Kelola Pengguna | Sukses - Edit Data Pengguna | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Pilih pengguna dan klik icon "Edit"<br>4. Ubah data: nama, status<br>5. Klik tombol "Simpan" | Nama baru: Budi Santoso Jaya<br>Status: Aktif | Data pengguna berhasil diubah dan perubahan tersimpan | |
| 10 | USER-005 | Kelola Pengguna | Sukses - Hapus Pengguna | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Pilih pengguna dan klik icon "Hapus"<br>4. Modal konfirmasi muncul<br>5. Klik "Hapus" untuk mengonfirmasi | - | Pengguna berhasil dihapus, tidak muncul di daftar pengguna | |
| 11 | USER-006 | Kelola Pengguna | Sukses - Ubah Status Pengguna (Blokir) | 1. Login sebagai admin<br>2. Buka halaman /admin/users<br>3. Pilih pengguna dan klik "Ubah Status"<br>4. Pilih status "Tidak Aktif"<br>5. Klik "Simpan" | Username: peminjam1 | Status pengguna berhasil diubah menjadi "Tidak Aktif", pengguna tidak bisa login | |

---

## MANAJEMEN GENRE

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 12 | GNR-001 | Genre Buku | Sukses - Lihat Daftar Genre | 1. Login sebagai admin<br>2. Buka halaman /admin/genre<br>3. Tunggu data dimuat | Username: admin<br>Password: Admin123 | Daftar genre tampil dengan nama dan jumlah buku per genre | |
| 13 | GNR-002 | Genre Buku | Sukses - Tambah Genre Baru | 1. Login sebagai admin<br>2. Buka halaman /admin/genre<br>3. Klik tombol "Tambah Genre"<br>4. Isi nama genre<br>5. Klik tombol "Simpan" | Nama Genre: Fiksi Ilmiah | Genre baru berhasil ditambahkan dan muncul di daftar | |
| 14 | GNR-003 | Genre Buku | Gagal - Tambah Genre dengan Nama Duplikat | 1. Login sebagai admin<br>2. Buka halaman /admin/genre<br>3. Klik tombol "Tambah Genre"<br>4. Isi nama genre yang sudah ada<br>5. Klik tombol "Simpan" | Nama: Novel (sudah ada) | Muncul pesan "Genre sudah ada" | |
| 15 | GNR-004 | Genre Buku | Sukses - Edit Genre | 1. Login sebagai admin<br>2. Buka halaman /admin/genre<br>3. Pilih genre dan klik "Edit"<br>4. Ubah nama genre<br>5. Klik tombol "Simpan" | Nama lama: Sains<br>Nama baru: Sains Populer | Genre berhasil diubah dan perubahan tersimpan | |
| 16 | GNR-005 | Genre Buku | Sukses - Hapus Genre (Tanpa Buku) | 1. Login sebagai admin<br>2. Buka halaman /admin/genre<br>3. Pilih genre kosong (tanpa buku)<br>4. Klik "Hapus"<br>5. Konfirmasi penghapusan | - | Genre berhasil dihapus dari daftar | |

---

## MANAJEMEN BUKU

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 17 | BKU-001 | Kelola Buku | Sukses - Lihat Daftar Buku | 1. Login sebagai admin<br>2. Buka halaman /admin/buku<br>3. Tunggu data dimuat | Username: admin<br>Password: Admin123 | Daftar buku tampil dengan detail: kode/ID, judul, genre, stok, kondisi | |
| 18 | BKU-002 | Kelola Buku | Sukses - Tambah Buku Baru | 1. Login sebagai admin<br>2. Buka halaman /admin/buku<br>3. Klik tombol "Tambah Buku"<br>4. Isi form: kode/ID, judul, genre, stok, kondisi<br>5. Klik tombol "Simpan" | Kode: BK-005<br>Judul: Laskar Pelangi<br>Genre: Novel<br>Stok: 3<br>Kondisi: Baik | Buku baru berhasil ditambahkan dan muncul di daftar | |
| 19 | BKU-003 | Kelola Buku | Gagal - Tambah Buku dengan Kode Duplikat | 1. Login sebagai admin<br>2. Buka halaman /admin/buku<br>3. Klik tombol "Tambah Buku"<br>4. Isi form dengan kode/ID yang sudah ada<br>5. Klik tombol "Simpan" | Kode: BK-001 (sudah ada) | Muncul pesan "Kode buku sudah terdaftar" | |
| 20 | BKU-004 | Kelola Buku | Sukses - Edit Data Buku | 1. Login sebagai admin<br>2. Buka halaman /admin/buku<br>3. Pilih buku dan klik "Edit"<br>4. Ubah stok, kondisi, informasi buku<br>5. Klik tombol "Simpan" | Kode: BK-001<br>Stok baru: 5<br>Kondisi: Rusak Ringan | Data buku berhasil diubah dan perubahan tersimpan | |
| 21 | BKU-005 | Kelola Buku | Sukses - Hapus Buku | 1. Login sebagai admin<br>2. Buka halaman /admin/buku<br>3. Pilih buku dan klik "Hapus"<br>4. Modal konfirmasi muncul<br>5. Klik "Hapus" untuk mengonfirmasi | - | Buku berhasil dihapus dari daftar dan stok berkurang | |

---

## KATALOG & CART

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 22 | KTLG-001 | Katalog Buku | Sukses - Lihat Katalog Buku | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/katalog<br>3. Tunggu data dimuat | Username: peminjam1<br>Password: Peminjam123 | Katalog buku tampil dengan detail: judul, genre, stok tersedia, deskripsi | |
| 23 | KTLG-002 | Katalog Buku | Sukses - Filter Buku berdasarkan Genre | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/katalog<br>3. Pilih genre spesifik (misal: Novel)<br>4. Lihat hasil filter | Genre: Novel | Daftar buku difilter sesuai genre yang dipilih, menampilkan hanya buku dari genre Novel | |
| 24 | CART-001 | Keranjang | Sukses - Tambah Buku ke Keranjang | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/katalog<br>3. Pilih buku: "Bumi Manusia"<br>4. Klik tombol "Tambah ke Keranjang"<br>5. Konfirmasi | - | Buku berhasil ditambahkan ke keranjang, badge keranjang menunjukkan jumlah item | |
| 25 | CART-002 | Keranjang | Sukses - Lihat Keranjang Peminjaman | 1. Login sebagai peminjam<br>2. Klik icon keranjang / buka /peminjam/cart<br>3. Tunggu daftar item dimuat | - | Daftar buku dalam keranjang ditampilkan dengan detail dan tombol aksi | |
| 26 | CART-003 | Keranjang | Sukses - Hapus Buku dari Keranjang | 1. Login sebagai peminjam<br>2. Buka halaman keranjang<br>3. Pilih buku dalam keranjang<br>4. Klik tombol "Hapus"<br>5. Konfirmasi penghapusan | - | Buku berhasil dihapus dari keranjang, daftar keranjang terupdate | |

---

## PEMINJAMAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 27 | PNJM-001 | Peminjaman | Sukses - Ajukan Peminjaman dari Katalog | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/katalog<br>3. Pilih buku: "Bumi Manusia"<br>4. Isi alasan peminjaman<br>5. Isi durasi yang diinginkan<br>6. Klik "Ajukan" | Buku: Bumi Manusia<br>Alasan: Untuk referensi skripsi<br>Durasi: 7 hari | Peminjaman berhasil diajukan dengan status "Menunggu Persetujuan" | |
| 28 | PNJM-002 | Peminjaman | Sukses - Ajukan Peminjaman dari Keranjang | 1. Login sebagai peminjam<br>2. Buka keranjang dan tambah 2 buku<br>3. Klik "Lanjutkan Checkout"<br>4. Isi alasan peminjaman<br>5. Isi durasi<br>6. Klik "Ajukan" | Buku: Bumi Manusia, Pulang<br>Alasan: Bacaan akhir pekan<br>Durasi: 5 hari | Peminjaman multiple berhasil diajukan dengan status "Menunggu Persetujuan" | |
| 29 | PNJM-003 | Peminjaman | Gagal - Ajukan Peminjaman saat Sudah 2 Peminjaman Aktif | 1. Login sebagai peminjam dengan 2 peminjaman aktif<br>2. Coba ajukan peminjaman baru<br>3. Lihat pesan yang muncul | Username: peminjam_limit | Muncul pesan "Sudah mencapai maksimal 2 peminjaman aktif" | |
| 30 | PNJM-004 | Peminjaman | Gagal - Ajukan Peminjaman saat Ada Peminjaman Terlambat | 1. Login sebagai peminjam dengan peminjaman terlambat<br>2. Coba ajukan peminjaman baru<br>3. Lihat pesan yang muncul | Username: peminjam_late | Muncul pesan "Ada peminjaman terlambat, silakan kembalikan terlebih dahulu" | |
| 31 | PNJM-005 | Peminjaman | Sukses - Lihat Daftar Riwayat Peminjaman | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/riwayat<br>3. Tunggu data dimuat | Username: peminjam1<br>Password: Peminjam123 | Daftar peminjaman tampil dengan detail: buku, tanggal ajuan, tanggal kembali, status, durasi | |
| 32 | PNJM-006 | Peminjaman | Sukses - Filter Peminjaman berdasarkan Status | 1. Login sebagai peminjam<br>2. Buka halaman riwayat peminjaman<br>3. Pilih filter status "Sedang Dipinjam"<br>4. Lihat hasil filter | Filter: Sedang Dipinjam | Daftar difilter, menampilkan hanya peminjaman dengan status "Sedang Dipinjam" | |
| 33 | PNJM-007 | Peminjaman | Sukses - Batalkan Peminjaman (Status Menunggu) | 1. Login sebagai peminjam<br>2. Lihat peminjaman dengan status "Menunggu Persetujuan"<br>3. Klik tombol "Batalkan"<br>4. Konfirmasi pembatalan | - | Peminjaman berhasil dibatalkan, status berubah menjadi "Dibatalkan" | |
| 34 | PNJM-008 | Peminjaman | Gagal - Batalkan Peminjaman (Status Sedang Dipinjam) | 1. Login sebagai peminjam<br>2. Cari peminjaman dengan status "Sedang Dipinjam"<br>3. Coba klik tombol "Batalkan"<br>4. Periksa apa yang terjadi | - | Tombol batalkan disabled/tidak tersedia, muncul pesan "Tidak bisa membatalkan peminjaman yang sedang dipinjam" | |
| 35 | PNJM-009 | Peminjaman | Sukses - Lihat Detail Peminjaman | 1. Login sebagai peminjam<br>2. Buka halaman riwayat peminjaman<br>3. Klik salah satu peminjaman<br>4. Lihat detail lengkap | - | Detail peminjaman tampil dengan info lengkap: buku, tanggal, durasi, alasan, riwayat perpanjangan (jika ada) | |
| 36 | PNJM-010 | Peminjaman | Sukses - Ajukan Perpanjangan Peminjaman | 1. Login sebagai peminjam<br>2. Buka halaman riwayat peminjaman<br>3. Pilih peminjaman yang sedang aktif<br>4. Klik "Ajukan Perpanjangan"<br>5. Isi durasi tambahan<br>6. Klik "Ajukan" | Durasi tambahan: 3 hari | Perpanjangan berhasil diajukan, muncul di riwayat perpanjangan peminjaman | |

---

## PERSETUJUAN PEMINJAMAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 37 | APPR-001 | Persetujuan Peminjaman | Sukses - Petugas Lihat Daftar Peminjaman Menunggu | 1. Login sebagai petugas<br>2. Buka halaman /petugas/approval<br>3. Tunggu data dimuat | Username: petugas1<br>Password: Petugas123 | Daftar peminjaman dengan status "Menunggu Persetujuan" tampil lengkap | |
| 38 | APPR-002 | Persetujuan Peminjaman | Sukses - Petugas Setujui Peminjaman | 1. Login sebagai petugas<br>2. Buka halaman /petugas/approval<br>3. Pilih peminjaman dan klik "Setujui"<br>4. Isi durasi peminjaman<br>5. Klik "Konfirmasi" | Durasi: 7 hari | Peminjaman berhasil disetujui, status berubah menjadi "Sedang Dipinjam", stok buku berkurang | |
| 39 | APPR-003 | Persetujuan Peminjaman | Sukses - Petugas Tolak Peminjaman | 1. Login sebagai petugas<br>2. Buka halaman /petugas/approval<br>3. Pilih peminjaman dan klik "Tolak"<br>4. Isi alasan penolakan<br>5. Klik "Konfirmasi" | Alasan: Buku sedang direstorasi/hilang | Peminjaman ditolak, status berubah menjadi "Ditolak", muncul pesan alasan penolakan | |
| 40 | APPR-004 | Persetujuan Peminjaman | Sukses - Petugas Lihat Detail Peminjaman | 1. Login sebagai petugas<br>2. Buka halaman /petugas/approval<br>3. Klik peminjaman untuk melihat detail<br>4. Lihat informasi lengkap | - | Detail peminjaman tampil dengan info peminjam, buku, alasan, durasi yang diminta | |
| 41 | APPR-005 | Persetujuan Peminjaman | Sukses - Petugas Lihat Riwayat Perpanjangan Peminjaman | 1. Login sebagai petugas<br>2. Buka halaman /petugas/approval<br>3. Pilih peminjaman yang sedang aktif<br>4. Lihat tab "Riwayat Perpanjangan"<br>5. Lihat daftar perpanjangan (jika ada) | - | Riwayat perpanjangan tampil dengan detail: tanggal permohonan, durasi, status approval | |

---

## PENGEMBALIAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 42 | PGLB-001 | Pengembalian | Sukses - Lihat Daftar Peminjaman untuk Pengembalian | 1. Login sebagai petugas<br>2. Buka halaman /petugas/pengembalian<br>3. Tunggu data dimuat | Username: petugas1<br>Password: Petugas123 | Daftar peminjaman dengan status "Sedang Dipinjam" tampil untuk proses pengembalian | |
| 43 | PGLB-002 | Pengembalian | Sukses - Proses Pengembalian (Kondisi Baik) | 1. Login sebagai petugas<br>2. Buka halaman /petugas/pengembalian<br>3. Pilih peminjaman<br>4. Pilih kondisi "Baik"<br>5. Klik "Proses Pengembalian" | Kondisi: Baik | Pengembalian berhasil diproses, status berubah menjadi "Dikembalikan", buku kembali ke stok, tidak ada denda | |
| 44 | PGLB-003 | Pengembalian | Sukses - Proses Pengembalian (Rusak Ringan) | 1. Login sebagai petugas<br>2. Buka halaman /petugas/pengembalian<br>3. Pilih peminjaman<br>4. Pilih kondisi "Rusak Ringan"<br>5. Input nominal denda kerusakan<br>6. Klik "Proses Pengembalian" | Kondisi: Rusak Ringan<br>Denda: Rp 50.000 | Pengembalian diproses dengan status "Dikembalikan", denda kerusakan tercatat | |
| 45 | PGLB-004 | Pengembalian | Sukses - Proses Pengembalian (Rusak Berat) | 1. Login sebagai petugas<br>2. Buka halaman /petugas/pengembalian<br>3. Pilih peminjaman<br>4. Pilih kondisi "Rusak Berat"<br>5. Input nominal denda kerusakan<br>6. Klik "Proses Pengembalian" | Kondisi: Rusak Berat<br>Denda: Rp 100.000 | Pengembalian diproses dengan status "Dikembalikan", denda kerusakan lebih besar tercatat | |
| 46 | PGLB-005 | Pengembalian | Sukses - Proses Pengembalian (Hilang) | 1. Login sebagai petugas<br>2. Buka halaman /petugas/pengembalian<br>3. Pilih peminjaman<br>4. Pilih kondisi "Hilang"<br>5. Input nominal denda sesuai harga buku<br>6. Klik "Proses Pengembalian" | Kondisi: Hilang<br>Denda: Rp 150.000 (sesuai harga buku) | Pengembalian diproses dengan status "Dikembalikan", denda hilang tercatat, buku tidak kembali ke stok | |

---

## DENDA

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 47 | DNDA-001 | Denda | Sukses - Hitung Denda Keterlambatan Otomatis | 1. Login sebagai petugas<br>2. Proses pengembalian untuk buku yang terlambat 3 hari<br>3. Pilih kondisi "Baik"<br>4. Klik "Proses Pengembalian"<br>5. Verifikasi denda keterlambatan | Terlambat: 3 hari<br>Tarif denda: Rp 10.000/hari | Denda keterlambatan otomatis dihitung (3 × Rp 10.000 = Rp 30.000) dan ditampilkan | |
| 48 | DNDA-002 | Denda | Sukses - Lihat Daftar Denda Saya (Peminjam) | 1. Login sebagai peminjam<br>2. Buka halaman /peminjam/denda<br>3. Tunggu data dimuat | Username: peminjam1<br>Password: Peminjam123 | Daftar denda saya tampil dengan detail: buku, jumlah denda, jenis (keterlambatan/kerusakan), status pembayaran, tanggal | |
| 49 | DNDA-003 | Denda | Sukses - Lihat Semua Denda (Petugas) | 1. Login sebagai petugas<br>2. Buka halaman /petugas/denda<br>3. Tunggu data dimuat<br>4. Lihat daftar denda dari semua peminjam | Username: petugas1<br>Password: Petugas123 | Daftar denda tampil dengan info: peminjam, buku, nominal, jenis, status, tanggal | |
| 50 | DNDA-004 | Denda | Sukses - Filter Denda berdasarkan Status | 1. Login sebagai petugas<br>2. Buka halaman /petugas/denda<br>3. Pilih filter status "Belum Bayar"<br>4. Lihat hasil filter | Filter: Belum Bayar | Daftar denda difilter, menampilkan hanya denda yang statusnya "Belum Bayar" | |
| 51 | DNDA-005 | Denda | Sukses - Catat Pembayaran Denda | 1. Login sebagai petugas<br>2. Buka halaman /petugas/denda<br>3. Pilih denda dengan status "Belum Bayar"<br>4. Klik "Catat Pembayaran"<br>5. Isi tanggal pembayaran dan metode<br>6. Klik "Konfirmasi" | Tanggal: 11 Februari 2026<br>Metode: Cash | Denda berhasil dicatat sebagai "Lunas", tanggal pembayaran tersimpan, peminjam dapat melihat status bayar | |
| 52 | DNDA-006 | Denda | Sukses - Lihat Detail Denda | 1. Login sebagai peminjam/petugas<br>2. Buka halaman denda<br>3. Klik salah satu denda untuk melihat detail<br>4. Lihat informasi lengkap | - | Detail denda tampil dengan info lengkap: peminjam, buku, penyebab (keterlambatan/kerusakan), nominal, tanggal | |

---

## LAPORAN

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 53 | LPRN-001 | Laporan | Sukses - Generate Laporan Peminjaman | 1. Login sebagai petugas<br>2. Buka halaman /petugas/laporan<br>3. Pilih periode: 01 Februari - 28 Februari 2026<br>4. Klik "Lihat Laporan" | Tanggal dari: 01-02-2026<br>Tanggal sampai: 28-02-2026 | Laporan peminjaman berhasil dibuat dengan data lengkap: jumlah peminjaman, buku terbanyak dipinjam, rata-rata durasi | |
| 54 | LPRN-002 | Laporan | Sukses - Generate Laporan Denda | 1. Login sebagai petugas<br>2. Buka halaman /petugas/laporan-denda<br>3. Pilih periode<br>4. Pilih filter status denda<br>5. Klik "Lihat Laporan" | Periode: 01-02-2026 s/d 28-02-2026<br>Filter: Semua | Laporan denda berhasil dibuat dengan summary total denda dan detail per peminjam | |
| 55 | LPRN-003 | Laporan | Sukses - Download Laporan PDF | 1. Login sebagai petugas<br>2. Buka halaman laporan<br>3. Generate laporan (sesuai langkah TC-53 atau TC-54)<br>4. Klik tombol "Download PDF"<br>5. Tunggu file selesai diunduh | - | File PDF berhasil diunduh dengan nama file yang sesuai dan format laporan rapi | |
| 56 | LPRN-004 | Laporan | Sukses - Export Laporan Excel | 1. Login sebagai petugas<br>2. Buka halaman laporan<br>3. Generate laporan<br>4. Klik tombol "Export Excel"<br>5. Tunggu file selesai diunduh | - | File Excel berhasil diunduh dengan data terformat dan readable di Ms. Excel / Spreadsheet | |

---

## NOTIFIKASI

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 57 | NOTIF-001 | Notifikasi | Sukses - Terima Notifikasi Persetujuan/Penolakan Peminjaman | 1. Login sebagai peminjam<br>2. Ajukan peminjaman buku<br>3. Logout<br>4. Login sebagai petugas dan setujui/tolak peminjaman<br>5. Login kembali sebagai peminjam<br>6. Periksa notifikasi | - | Notifikasi muncul di bell icon mengenai status persetujuan/penolakan peminjaman | |
| 58 | NOTIF-002 | Notifikasi | Sukses - Lihat Daftar Semua Notifikasi | 1. Login dengan akun apapun (admin/petugas/peminjam)<br>2. Klik bell icon di header<br>3. Lihat daftar notifikasi | - | Daftar notifikasi tampil dengan isi, waktu, dan status baca | |
| 59 | NOTIF-003 | Notifikasi | Sukses - Tandai Notifikasi sebagai Sudah Dibaca | 1. Login dengan akun apapun<br>2. Klik bell icon<br>3. Pilih notifikasi yang belum dibaca<br>4. Klik "Tandai Baca" atau klik notifikasi | - | Notifikasi berhasil ditandai sebagai sudah dibaca, badge indicator berkurang | |

---

## LOG AKTIVITAS

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 60 | LOG-001 | Log Aktivitas | Sukses - Lihat Daftar Log Aktivitas | 1. Login sebagai admin<br>2. Buka halaman /admin/log<br>3. Tunggu data dimuat | Username: admin<br>Password: Admin123 | Daftar log aktivitas tampil dengan detail: user, jenis aktivitas, deskripsi, waktu, IP address | |
| 61 | LOG-002 | Log Aktivitas | Sukses - Filter Log Aktivitas berdasarkan Jenis | 1. Login sebagai admin<br>2. Buka halaman /admin/log<br>3. Pilih filter jenis aktivitas (misal: Login)<br>4. Lihat hasil filter | Filter: Login | Daftar log difilter, menampilkan hanya aktivitas dengan jenis "Login" | |

---

## DASHBOARD

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|--------------------|-----------------|-----------------------|----------------------|---------------------------|
| 62 | DASH-001 | Dashboard Admin | Sukses - Lihat Dashboard Admin | 1. Login sebagai admin<br>2. Halaman dashboard dimuat secara otomatis<br>3. Tunggu data statistik dimuat | Username: admin<br>Password: Admin123 | Dashboard menampilkan: total pengguna, total buku, total peminjaman aktif, daftar aktivitas terbaru, grafik peminjaman | |
| 63 | DASH-002 | Dashboard Petugas | Sukses - Lihat Dashboard Petugas | 1. Login sebagai petugas<br>2. Halaman dashboard dimuat<br>3. Tunggu data statistik dimuat | Username: petugas1<br>Password: Petugas123 | Dashboard menampilkan: peminjaman menunggu, pengembalian hari ini, denda belum bayar, grafik persetujuan/penolakan | |
| 64 | DASH-003 | Dashboard Peminjam | Sukses - Lihat Dashboard Peminjam | 1. Login sebagai peminjam<br>2. Halaman dashboard dimuat<br>3. Tunggu data statistik dimuat | Username: peminjam1<br>Password: Peminjam123 | Dashboard menampilkan: peminjaman aktif, riwayat peminjaman, denda saya, katalog buku populer, notifikasi terbaru | |

---

## RINGKASAN

**Total Test Cases: 64**

| Modul | Jumlah TC | Status |
|-------|-----------|--------|
| Autentikasi | 5 | - |
| Manajemen Pengguna | 6 | - |
| Manajemen Genre | 5 | - |
| Manajemen Buku | 5 | - |
| Katalog & Cart | 5 | - |
| Peminjaman | 10 | - |
| Persetujuan Peminjaman | 5 | - |
| Pengembalian | 5 | - |
| Denda | 6 | - |
| Laporan | 4 | - |
| Notifikasi | 3 | - |
| Log Aktivitas | 2 | - |
| Dashboard | 3 | - |
| **TOTAL** | **64** | - |

---

**Catatan:**
- Format testing mengikuti standar dokumentasi pengujian sistem informasi
- Setiap test case dirancang untuk menguji fungsionalitas spesifik modul
- Kolom "Hasil Aktual (Lulus/Gagal)" diisi saat melakukan testing
- Test data dapat disesuaikan dengan sistem dan data yang ada
- Rekomendasi: Lakukan testing dengan urutan sesuai dependency (misal: Auth dulu, kemudian CRUD operations)
