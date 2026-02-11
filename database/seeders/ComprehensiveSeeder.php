<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Booking;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Pengembalian;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Comprehensive Seeder - Membuat data realistis untuk semua tabel
 * 
 * Seeder ini akan membuat:
 * - 3 Role (Admin, Petugas, Peminjam)
 * - 50+ Users (1 Admin, 3 Petugas, 46+ Peminjam)
 * - 8 Kategori alat
 * - 40+ Alat dengan berbagai kategori
 * - 5 Tarif Denda
 * - 100+ Peminjaman dengan berbagai status
 * - Pengembalian untuk peminjaman yang selesai
 * - Notifikasi untuk users
 * - Log Aktivitas
 * - Booking untuk alat yang sedang dipinjam
 */
class ComprehensiveSeeder extends Seeder
{
    private $admin;
    private $petugasUsers = [];
    private $peminjamUsers = [];
    private $alatList = [];

    public function run(): void
    {
        $this->command->info('🚀 Memulai Comprehensive Seeder...');

        // 1. Create Roles
        $this->createRoles();
        
        // 2. Create Users
        $this->createUsers();
        
        // 3. Create Kategori
        $this->createKategori();
        
        // 4. Create Alat
        $this->createAlat();
        
        // 5. Create Denda
        $this->createDenda();
        
        // 6. Create Peminjaman with various statuses
        $this->createPeminjaman();
        
        // 7. Create Booking
        $this->createBooking();
        
        // 8. Create Notifikasi
        $this->createNotifikasi();
        
        // 9. Create Log Aktivitas
        $this->createLogAktivitas();

        $this->command->info('✅ Comprehensive Seeder selesai!');
        $this->command->newLine();
        $this->command->info('📊 Ringkasan Data:');
        $this->command->info('   - Roles: ' . Role::count());
        $this->command->info('   - Users: ' . User::count());
        $this->command->info('   - Kategori: ' . Kategori::count());
        $this->command->info('   - Alat: ' . Alat::count());
        $this->command->info('   - Denda: ' . Denda::count());
        $this->command->info('   - Peminjaman: ' . Peminjaman::count());
        $this->command->info('   - Pengembalian: ' . Pengembalian::count());
        $this->command->info('   - Booking: ' . Booking::count());
        $this->command->info('   - Notifikasi: ' . Notifikasi::count());
        $this->command->info('   - Log Aktivitas: ' . LogAktivitas::count());
    }

    private function createRoles(): void
    {
        $this->command->info('📝 Membuat Roles...');
        
        $roles = ['Admin', 'Petugas', 'Peminjam'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['nama_role' => $role]);
        }
    }

    private function createUsers(): void
    {
        $this->command->info('👥 Membuat Users...');

        // Admin
        $this->admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@pinjamin.test',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Petugas
        $petugasNames = [
            ['name' => 'Budi Santoso', 'username' => 'budi.petugas'],
            ['name' => 'Siti Rahayu', 'username' => 'siti.petugas'],
            ['name' => 'Ahmad Fauzi', 'username' => 'ahmad.petugas'],
        ];

        foreach ($petugasNames as $index => $petugas) {
            $user = User::firstOrCreate(
                ['username' => $petugas['username']],
                [
                    'name' => $petugas['name'],
                    'email' => $petugas['username'] . '@pinjamin.test',
                    'password' => Hash::make('password'),
                    'role_id' => 2,
                    'status' => 'active',
                    'email_verified_at' => now(),
                    'created_at' => now()->subDays(rand(30, 90)),
                ]
            );
            $this->petugasUsers[] = $user;
        }

        // Peminjam - Nama Indonesia yang realistis
        $peminjamNames = [
            'Andi Wijaya', 'Dewi Lestari', 'Rizki Pratama', 'Putri Anggraini', 'Fajar Nugroho',
            'Maya Sari', 'Dimas Prasetyo', 'Fitri Handayani', 'Arif Rahman', 'Novi Susanti',
            'Bagus Setiawan', 'Rina Wulandari', 'Yoga Permana', 'Linda Kusuma', 'Hendra Gunawan',
            'Sinta Dewi', 'Bayu Pratama', 'Ani Rahmawati', 'Rudi Hartono', 'Yuni Astuti',
            'Agus Supriadi', 'Eka Safitri', 'Doni Saputra', 'Wati Kurniawati', 'Joko Widodo',
            'Ratna Sari', 'Toni Sucipto', 'Mega Puspita', 'Eko Prasetyo', 'Lina Marlina',
            'Bambang Sudrajat', 'Windi Anggara', 'Irfan Hakim', 'Dina Mariana', 'Surya Atmaja',
            'Intan Permatasari', 'Rangga Pratama', 'Citra Dewi', 'Galih Ramadhan', 'Tika Amelia',
            'Feri Kurniawan', 'Aisyah Zahra', 'Reza Mahendra', 'Bunga Citra', 'Wahyu Hidayat',
            'Nurul Hidayah'
        ];

        foreach ($peminjamNames as $index => $name) {
            $username = strtolower(str_replace(' ', '.', $name));
            $statuses = ['active', 'active', 'active', 'active', 'pending']; // 80% active, 20% pending
            
            $user = User::firstOrCreate(
                ['username' => $username],
                [
                    'name' => $name,
                    'email' => $username . '@pinjamin.test',
                    'password' => Hash::make('password'),
                    'role_id' => 3,
                    'status' => $statuses[array_rand($statuses)],
                    'email_verified_at' => now(),
                    'created_at' => now()->subDays(rand(1, 180)),
                ]
            );
            
            if ($user->status === 'active') {
                $this->peminjamUsers[] = $user;
            }
        }
    }

    private function createKategori(): void
    {
        $this->command->info('📁 Membuat Kategori...');

        $kategoris = [
            'Elektronik',
            'Perkakas',
            'Alat Ukur',
            'Alat Laboratorium',
            'Komputer & Aksesoris',
            'Audio Visual',
            'Alat Kebersihan',
            'Peralatan Olahraga',
        ];

        foreach ($kategoris as $k) {
            Kategori::firstOrCreate(['nama_kategori' => $k]);
        }
    }

    private function createAlat(): void
    {
        $this->command->info('🔧 Membuat Alat...');

        $alatData = [
            // Elektronik
            ['nama_alat' => 'Laptop ASUS ROG', 'kategori' => 'Elektronik', 'stok' => 8, 'deskripsi' => 'Laptop gaming untuk kebutuhan desain dan pemrograman'],
            ['nama_alat' => 'Laptop Dell Latitude', 'kategori' => 'Elektronik', 'stok' => 12, 'deskripsi' => 'Laptop bisnis dengan performa tinggi'],
            ['nama_alat' => 'Laptop HP ProBook', 'kategori' => 'Elektronik', 'stok' => 10, 'deskripsi' => 'Laptop untuk kebutuhan kantor dan presentasi'],
            ['nama_alat' => 'Tablet Samsung Galaxy', 'kategori' => 'Elektronik', 'stok' => 6, 'deskripsi' => 'Tablet untuk presentasi dan demo'],
            ['nama_alat' => 'iPad Pro 12.9"', 'kategori' => 'Elektronik', 'stok' => 4, 'deskripsi' => 'Tablet premium untuk desain digital'],

            // Perkakas
            ['nama_alat' => 'Bor Listrik Bosch', 'kategori' => 'Perkakas', 'stok' => 5, 'deskripsi' => 'Bor listrik untuk pekerjaan bengkel'],
            ['nama_alat' => 'Gerinda Tangan Makita', 'kategori' => 'Perkakas', 'stok' => 4, 'deskripsi' => 'Gerinda tangan untuk memotong dan menghaluskan'],
            ['nama_alat' => 'Mesin Las Listrik', 'kategori' => 'Perkakas', 'stok' => 3, 'deskripsi' => 'Mesin las untuk pekerjaan pengelasan dasar'],
            ['nama_alat' => 'Tool Kit Lengkap Stanley', 'kategori' => 'Perkakas', 'stok' => 8, 'deskripsi' => 'Set peralatan lengkap untuk berbagai pekerjaan'],
            ['nama_alat' => 'Jigsaw Black & Decker', 'kategori' => 'Perkakas', 'stok' => 4, 'deskripsi' => 'Gergaji listrik untuk pemotongan presisi'],

            // Alat Ukur
            ['nama_alat' => 'Multimeter Digital Fluke', 'kategori' => 'Alat Ukur', 'stok' => 15, 'deskripsi' => 'Multimeter digital presisi tinggi'],
            ['nama_alat' => 'Oscilloscope Tektronix', 'kategori' => 'Alat Ukur', 'stok' => 3, 'deskripsi' => 'Oscilloscope untuk analisis sinyal'],
            ['nama_alat' => 'Clamp Meter Kyoritsu', 'kategori' => 'Alat Ukur', 'stok' => 8, 'deskripsi' => 'Clamp meter untuk pengukuran arus'],
            ['nama_alat' => 'Thermometer Infrared', 'kategori' => 'Alat Ukur', 'stok' => 10, 'deskripsi' => 'Termometer non-kontak untuk pengukuran suhu'],
            ['nama_alat' => 'Sound Level Meter', 'kategori' => 'Alat Ukur', 'stok' => 5, 'deskripsi' => 'Alat ukur tingkat kebisingan'],

            // Alat Laboratorium
            ['nama_alat' => 'Mikroskop Digital', 'kategori' => 'Alat Laboratorium', 'stok' => 6, 'deskripsi' => 'Mikroskop dengan kamera digital terintegrasi'],
            ['nama_alat' => 'Timbangan Analitik', 'kategori' => 'Alat Laboratorium', 'stok' => 4, 'deskripsi' => 'Timbangan presisi untuk laboratorium'],
            ['nama_alat' => 'Centrifuge Mini', 'kategori' => 'Alat Laboratorium', 'stok' => 3, 'deskripsi' => 'Centrifuge portable untuk sampel kecil'],
            ['nama_alat' => 'pH Meter Digital', 'kategori' => 'Alat Laboratorium', 'stok' => 8, 'deskripsi' => 'Alat ukur pH digital akurat'],
            ['nama_alat' => 'Hot Plate Stirrer', 'kategori' => 'Alat Laboratorium', 'stok' => 5, 'deskripsi' => 'Pemanas dengan pengaduk magnetik'],

            // Komputer & Aksesoris
            ['nama_alat' => 'PC Desktop Core i7', 'kategori' => 'Komputer & Aksesoris', 'stok' => 10, 'deskripsi' => 'Komputer desktop performa tinggi'],
            ['nama_alat' => 'Monitor 27" 4K', 'kategori' => 'Komputer & Aksesoris', 'stok' => 8, 'deskripsi' => 'Monitor resolusi tinggi untuk desain'],
            ['nama_alat' => 'Keyboard Mechanical', 'kategori' => 'Komputer & Aksesoris', 'stok' => 15, 'deskripsi' => 'Keyboard mekanik untuk produktivitas'],
            ['nama_alat' => 'Mouse Wireless Logitech', 'kategori' => 'Komputer & Aksesoris', 'stok' => 20, 'deskripsi' => 'Mouse wireless ergonomis'],
            ['nama_alat' => 'Webcam Logitech C920', 'kategori' => 'Komputer & Aksesoris', 'stok' => 12, 'deskripsi' => 'Webcam HD untuk video conference'],

            // Audio Visual
            ['nama_alat' => 'Proyektor Epson', 'kategori' => 'Audio Visual', 'stok' => 6, 'deskripsi' => 'Proyektor LCD untuk presentasi'],
            ['nama_alat' => 'Speaker Portable JBL', 'kategori' => 'Audio Visual', 'stok' => 8, 'deskripsi' => 'Speaker portable bluetooth'],
            ['nama_alat' => 'Microphone Wireless', 'kategori' => 'Audio Visual', 'stok' => 10, 'deskripsi' => 'Microphone wireless untuk presentasi'],
            ['nama_alat' => 'Kamera DSLR Canon', 'kategori' => 'Audio Visual', 'stok' => 4, 'deskripsi' => 'Kamera DSLR untuk dokumentasi'],
            ['nama_alat' => 'Tripod Kamera', 'kategori' => 'Audio Visual', 'stok' => 8, 'deskripsi' => 'Tripod untuk stabilitas kamera'],
            ['nama_alat' => 'LED Panel Light', 'kategori' => 'Audio Visual', 'stok' => 6, 'deskripsi' => 'Lampu LED untuk pencahayaan video'],

            // Alat Kebersihan
            ['nama_alat' => 'Vacuum Cleaner Industrial', 'kategori' => 'Alat Kebersihan', 'stok' => 4, 'deskripsi' => 'Vacuum cleaner untuk area luas'],
            ['nama_alat' => 'Pressure Washer', 'kategori' => 'Alat Kebersihan', 'stok' => 3, 'deskripsi' => 'Mesin cuci bertekanan tinggi'],
            ['nama_alat' => 'Blower Industrial', 'kategori' => 'Alat Kebersihan', 'stok' => 5, 'deskripsi' => 'Blower untuk membersihkan debu'],

            // Peralatan Olahraga
            ['nama_alat' => 'Bola Basket Molten', 'kategori' => 'Peralatan Olahraga', 'stok' => 10, 'deskripsi' => 'Bola basket official size'],
            ['nama_alat' => 'Bola Voli Mikasa', 'kategori' => 'Peralatan Olahraga', 'stok' => 8, 'deskripsi' => 'Bola voli standar pertandingan'],
            ['nama_alat' => 'Raket Badminton Yonex', 'kategori' => 'Peralatan Olahraga', 'stok' => 12, 'deskripsi' => 'Raket badminton berkualitas'],
            ['nama_alat' => 'Net Badminton', 'kategori' => 'Peralatan Olahraga', 'stok' => 4, 'deskripsi' => 'Net badminton standar'],
            ['nama_alat' => 'Matras Yoga', 'kategori' => 'Peralatan Olahraga', 'stok' => 15, 'deskripsi' => 'Matras untuk yoga dan senam'],
            ['nama_alat' => 'Stopwatch Digital', 'kategori' => 'Peralatan Olahraga', 'stok' => 10, 'deskripsi' => 'Stopwatch untuk kegiatan olahraga'],
        ];

        foreach ($alatData as $alat) {
            $kategori = Kategori::where('nama_kategori', $alat['kategori'])->first();
            if ($kategori) {
                $created = Alat::firstOrCreate(
                    ['nama_alat' => $alat['nama_alat']],
                    [
                        'kategori_id' => $kategori->id,
                        'stok' => $alat['stok'],
                        'deskripsi' => $alat['deskripsi'],
                    ]
                );
                $this->alatList[] = $created;
            }
        }
    }

    private function createDenda(): void
    {
        $this->command->info('💰 Membuat Tarif Denda...');

        $dendas = [
            [
                'nama_denda' => 'Denda Keterlambatan Standar',
                'tipe' => 'per_jam',
                'nominal' => 500,
                'deskripsi' => 'Denda untuk keterlambatan pengembalian per jam (Rp 500/jam)',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Keterlambatan Premium',
                'tipe' => 'per_jam',
                'nominal' => 1000,
                'deskripsi' => 'Denda untuk keterlambatan alat premium per jam (Rp 1.000/jam)',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Ringan',
                'tipe' => 'tetap',
                'nominal' => 50000,
                'deskripsi' => 'Denda untuk kerusakan ringan yang masih bisa diperbaiki',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Sedang',
                'tipe' => 'tetap',
                'nominal' => 150000,
                'deskripsi' => 'Denda untuk kerusakan sedang yang memerlukan perbaikan',
                'aktif' => true,
            ],
            [
                'nama_denda' => 'Denda Kerusakan Berat',
                'tipe' => 'tetap',
                'nominal' => 500000,
                'deskripsi' => 'Denda untuk kerusakan berat atau kehilangan',
                'aktif' => true,
            ],
        ];

        foreach ($dendas as $denda) {
            Denda::firstOrCreate(['nama_denda' => $denda['nama_denda']], $denda);
        }
    }

    private function createPeminjaman(): void
    {
        $this->command->info('📋 Membuat Peminjaman...');

        if (empty($this->peminjamUsers) || empty($this->alatList)) {
            $this->command->warn('   Tidak ada peminjam atau alat yang tersedia');
            return;
        }

        $petugas = $this->petugasUsers[0] ?? $this->admin;

        // Create various peminjaman with different statuses and dates
        for ($i = 0; $i < 120; $i++) {
            $user = $this->peminjamUsers[array_rand($this->peminjamUsers)];
            $status = $this->getRandomStatus();
            $daysAgo = rand(1, 90);
            
            $tanggalPinjam = now()->subDays($daysAgo);
            $tanggalKembali = $tanggalPinjam->copy()->addDays(rand(1, 7));

            $peminjaman = Peminjaman::create([
                'user_id' => $user->id,
                'tanggal_pinjam' => $status !== 'Pending' ? $tanggalPinjam : null,
                'tanggal_kembali' => $tanggalKembali,
                'status' => $status,
                'alasan_tolak' => $status === 'Ditolak' ? $this->getRandomRejectionReason() : null,
                'approved_by' => in_array($status, ['Dipinjam', 'Selesai', 'Ditolak']) ? $petugas->id : null,
                'approved_at' => in_array($status, ['Dipinjam', 'Selesai', 'Ditolak']) ? $tanggalPinjam : null,
                'returned_by' => $status === 'Selesai' ? $petugas->id : null,
                'returned_at' => $status === 'Selesai' ? $tanggalKembali->addDays(rand(0, 2)) : null,
                'created_at' => $tanggalPinjam->subDays(1),
                'updated_at' => now(),
            ]);

            // Create detail peminjaman (1-3 items)
            $numItems = rand(1, 3);
            $selectedAlat = collect($this->alatList)->random($numItems);
            
            foreach ($selectedAlat as $alat) {
                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alat->id,
                    'jumlah' => rand(1, min(3, $alat->stok)),
                ]);
            }

            // Create pengembalian for completed peminjaman
            if ($status === 'Selesai') {
                $isLate = rand(0, 100) < 20; // 20% chance of late return
                $isDamaged = rand(0, 100) < 10; // 10% chance of damage
                
                Pengembalian::create([
                    'peminjaman_id' => $peminjaman->id,
                    'tanggal_dikembalikan' => $peminjaman->returned_at ?? $tanggalKembali,
                    'denda' => $isLate ? rand(5, 50) * 1000 : ($isDamaged ? rand(50, 150) * 1000 : 0),
                    'kondisi' => $isDamaged ? 'Rusak' : 'Baik',
                    'catatan' => $isDamaged ? 'Ditemukan kerusakan pada alat' : ($isLate ? 'Terlambat mengembalikan' : null),
                ]);
            }
        }
    }

    private function createBooking(): void
    {
        $this->command->info('📅 Membuat Booking...');

        if (empty($this->peminjamUsers) || empty($this->alatList)) {
            return;
        }

        // Get active loans (status = Dipinjam)
        $activePeminjaman = Peminjaman::where('status', 'Dipinjam')->get();

        foreach ($activePeminjaman->take(15) as $peminjaman) {
            $user = $this->peminjamUsers[array_rand($this->peminjamUsers)];
            $alat = Alat::find($peminjaman->detail->first()->alat_id ?? null);
            
            if ($alat) {
                Booking::create([
                    'user_id' => $user->id,
                    'alat_id' => $alat->id,
                    'jumlah' => rand(1, 2),
                    'tanggal_booking' => $peminjaman->tanggal_kembali->addDays(1),
                    'tanggal_kembali' => $peminjaman->tanggal_kembali->addDays(rand(3, 7)),
                    'status' => ['Menunggu', 'Disetujui'][array_rand(['Menunggu', 'Disetujui'])],
                    'referensi_peminjaman_id' => $peminjaman->id,
                    'catatan' => 'Booking setelah peminjaman selesai',
                ]);
            }
        }
    }

    private function createNotifikasi(): void
    {
        $this->command->info('🔔 Membuat Notifikasi...');

        $messages = [
            'Peminjaman Anda telah disetujui',
            'Peminjaman Anda telah ditolak',
            'Reminder: Segera kembalikan alat yang dipinjam',
            'Pengembalian berhasil dicatat',
            'Booking Anda telah dikonfirmasi',
            'Ada peminjaman baru yang perlu disetujui',
            'Alat yang Anda booking sudah tersedia',
            'Denda keterlambatan telah dicatat',
            'Selamat datang di Pinjamin!',
            'Profil Anda telah diperbarui',
        ];

        $allUsers = array_merge([$this->admin], $this->petugasUsers, $this->peminjamUsers);

        foreach ($allUsers as $user) {
            $numNotif = rand(2, 8);
            for ($i = 0; $i < $numNotif; $i++) {
                Notifikasi::create([
                    'user_id' => $user->id,
                    'pesan' => $messages[array_rand($messages)],
                    'is_read' => rand(0, 100) < 60, // 60% sudah dibaca
                    'created_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }

    private function createLogAktivitas(): void
    {
        $this->command->info('📝 Membuat Log Aktivitas...');

        $activities = [
            'Login ke sistem',
            'Logout dari sistem',
            'Membuat peminjaman baru',
            'Menyetujui peminjaman',
            'Menolak peminjaman',
            'Memproses pengembalian',
            'Menambah alat baru',
            'Mengupdate data alat',
            'Menghapus alat',
            'Menambah kategori',
            'Mengupdate profil',
            'Mengubah password',
            'Menambah user baru',
            'Menyetujui pendaftaran user',
            'Membuat booking',
            'Membatalkan booking',
        ];

        $allUsers = array_merge([$this->admin], $this->petugasUsers, $this->peminjamUsers);

        for ($i = 0; $i < 200; $i++) {
            $user = $allUsers[array_rand($allUsers)];
            LogAktivitas::create([
                'user_id' => $user->id,
                'aktivitas' => $activities[array_rand($activities)],
                'timestamp' => now()->subDays(rand(0, 60))->subHours(rand(0, 23)),
            ]);
        }
    }

    private function getRandomStatus(): string
    {
        $statuses = ['Pending', 'Dipinjam', 'Dipinjam', 'Selesai', 'Selesai', 'Selesai', 'Ditolak'];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomRejectionReason(): string
    {
        $reasons = [
            'Stok alat tidak mencukupi',
            'Dokumen tidak lengkap',
            'Periode peminjaman terlalu lama',
            'Alat sedang dalam perbaikan',
            'Peminjam memiliki denda yang belum dibayar',
        ];
        return $reasons[array_rand($reasons)];
    }
}
