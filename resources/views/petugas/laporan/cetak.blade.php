<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Alat - Pinjamin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #4F46E5; padding-bottom: 15px; }
        .header h1 { font-size: 18px; color: #4F46E5; margin-bottom: 3px; }
        .header p { font-size: 11px; color: #666; }
        .meta { margin-bottom: 15px; }
        .meta p { font-size: 10px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #4F46E5; color: white; padding: 8px 6px; text-align: left; font-size: 10px; text-transform: uppercase; }
        td { padding: 6px; border-bottom: 1px solid #ddd; font-size: 10px; }
        tr:nth-child(even) { background-color: #F9FAFB; }
        .status-pending { color: #D97706; font-weight: bold; }
        .status-dipinjam { color: #2563EB; font-weight: bold; }
        .status-ditolak { color: #DC2626; font-weight: bold; }
        .status-selesai { color: #059669; font-weight: bold; }
        .footer { text-align: center; font-size: 9px; color: #999; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px; }
        .summary { margin-bottom: 15px; }
        .summary span { display: inline-block; margin-right: 15px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT</h1>
        <p>Aplikasi Pinjamin</p>
    </div>

    <div class="meta">
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
        @if(request('dari') || request('sampai'))
            <p>Periode: {{ request('dari', '-') }} s/d {{ request('sampai', '-') }}</p>
        @endif
        @if(request('status'))
            <p>Filter Status: {{ request('status') }}</p>
        @endif
    </div>

    <div class="summary">
        <span><strong>Total Data:</strong> {{ $peminjamans->count() }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Item</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $peminjaman)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $peminjaman->tanggal_kembali->format('d M Y') }}</td>
                    <td>
                        @foreach($peminjaman->detail as $detail)
                            {{ $detail->alat->nama_alat }} ({{ $detail->jumlah }}){{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td class="status-{{ strtolower($peminjaman->status) }}">{{ $peminjaman->status }}</td>
                    <td>{{ $peminjaman->pengembalian ? 'Rp ' . number_format($peminjaman->pengembalian->denda, 0, ',', '.') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh sistem Pinjamin &mdash; {{ now()->format('d M Y H:i') }}</p>
    </div>
</body>
</html>
