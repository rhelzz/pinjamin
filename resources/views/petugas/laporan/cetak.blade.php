<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Alat - Pinjamin</title>
    <style>
        @page { margin: 1.5cm; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            font-size: 9px; 
            color: #000; 
            line-height: 1.3;
        }
        .header { 
            text-align: center; 
            margin-bottom: 15px; 
            border: 2px solid #000; 
            padding: 10px; 
            background-color: #fff;
        }
        .header h1 { 
            font-size: 16px; 
            color: #000; 
            margin-bottom: 4px; 
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        .header h2 {
            font-size: 11px;
            color: #000;
            font-weight: normal;
            margin-bottom: 2px;
        }
        .header p { 
            font-size: 8px; 
            color: #333; 
        }
        .meta { 
            margin-bottom: 12px;
            padding: 8px 10px;
            background-color: #f5f5f5;
            border: 1px solid #000;
        }
        .meta-row {
            display: inline-block;
            margin-right: 20px;
        }
        .meta-label {
            font-weight: bold;
            color: #000;
        }
        .meta-value {
            color: #333;
        }
        .stats-container {
            margin-bottom: 12px;
            width: 100%;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
        }
        .stats-table td {
            text-align: center;
            padding: 6px 4px;
            border: 1px solid #000;
            background-color: #fff;
        }
        .stat-number {
            font-size: 14px;
            font-weight: bold;
            display: block;
            color: #000;
        }
        .stat-label {
            font-size: 8px;
            color: #333;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .main-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 12px;
            border: 2px solid #000;
        }
        .main-table th { 
            background-color: #000; 
            color: #fff; 
            padding: 6px 5px; 
            text-align: left; 
            font-size: 8px; 
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: bold;
            border: 1px solid #000;
        }
        .main-table td { 
            padding: 5px; 
            border: 1px solid #000; 
            font-size: 8px;
            vertical-align: top;
        }
        .main-table tr:nth-child(even) { 
            background-color: #f5f5f5; 
        }
        .status-pending { color: #000; font-weight: bold; }
        .status-dipinjam { color: #000; font-weight: bold; }
        .status-ditolak { color: #000; font-weight: bold; text-decoration: underline; }
        .status-selesai { color: #000; font-weight: bold; }
        
        .denda-summary {
            margin-top: 12px;
            padding: 10px;
            background-color: #e8e8e8;
            border: 2px solid #000;
            text-align: right;
        }
        .denda-summary h3 {
            font-size: 9px;
            color: #000;
            margin-bottom: 4px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .denda-amount {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
        
        .footer { 
            text-align: center; 
            font-size: 7px; 
            color: #333; 
            margin-top: 20px; 
            border-top: 1px solid #000; 
            padding-top: 10px; 
        }
        .page-number {
            position: fixed;
            bottom: 0.5cm;
            right: 0.5cm;
            font-size: 7px;
            color: #333;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #333;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT PRODUKTIF</h1>
        <h2>Sistem Pinjamin</h2>
        <p>Dokumen Resmi - Dicetak pada {{ now()->format('d F Y, H:i') }} WIB</p>
    </div>

    <div class="meta">
        <span class="meta-row">
            <span class="meta-label">Periode:</span>
            <span class="meta-value">
                @if($dari_tanggal && $sampai_tanggal)
                    {{ \Carbon\Carbon::parse($dari_tanggal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($sampai_tanggal)->format('d M Y') }}
                @elseif($dari_tanggal)
                    Mulai {{ \Carbon\Carbon::parse($dari_tanggal)->format('d M Y') }}
                @elseif($sampai_tanggal)
                    Sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->format('d M Y') }}
                @else
                    Semua Periode
                @endif
            </span>
        </span>
        @if($status)
        <span class="meta-row">
            <span class="meta-label">Filter Status:</span>
            <span class="meta-value">{{ ucfirst($status) }}</span>
        </span>
        @endif
    </div>

    <div class="stats-container">
        <table class="stats-table">
            <tr>
                <td>
                    <span class="stat-number">{{ $stats['total'] }}</span>
                    <span class="stat-label">Total Data</span>
                </td>
                <td>
                    <span class="stat-number">{{ $stats['pending'] }}</span>
                    <span class="stat-label">Pending</span>
                </td>
                <td>
                    <span class="stat-number">{{ $stats['dipinjam'] }}</span>
                    <span class="stat-label">Dipinjam</span>
                </td>
                <td>
                    <span class="stat-number">{{ $stats['selesai'] }}</span>
                    <span class="stat-label">Selesai</span>
                </td>
                <td>
                    <span class="stat-number">{{ $stats['ditolak'] }}</span>
                    <span class="stat-label">Ditolak</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 100px;">Peminjam</th>
                <th style="width: 70px;">Tgl Pinjam</th>
                <th style="width: 70px;">Tgl Kembali</th>
                <th>Alat yang Dipinjam</th>
                <th style="width: 60px;">Status</th>
                <th style="width: 80px; text-align: right;">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $peminjaman)
                <tr>
                    <td style="text-align: center;">{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $peminjaman->user->name }}</strong>
                        <br><span style="color: #333; font-size: 7px;">{{ $peminjaman->user->email }}</span>
                    </td>
                    <td>{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $peminjaman->tanggal_kembali->format('d M Y') }}</td>
                    <td>
                        @foreach($peminjaman->detail as $detail)
                            • {{ $detail->alat->nama_alat }} <span style="color: #333;">({{ $detail->jumlah }} unit)</span>{{ !$loop->last ? '<br>' : '' }}
                        @endforeach
                    </td>
                    <td class="status-{{ strtolower($peminjaman->status) }}">{{ ucfirst($peminjaman->status) }}</td>
                    <td style="text-align: right;">
                        @if($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                            <strong style="color: #000;">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</strong>
                        @else
                            <span style="color: #666;">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">Tidak ada data peminjaman untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($totalDenda > 0)
    <div class="denda-summary">
        <h3>Total Denda Periode Ini</h3>
        <span class="denda-amount">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
    </div>
    @endif

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh Sistem Pinjamin</p>
        <p>Aplikasi Peminjaman Alat Produktif &mdash; {{ now()->year }}</p>
    </div>
</body>
</html>
