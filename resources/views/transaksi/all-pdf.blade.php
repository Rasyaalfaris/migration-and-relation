<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .page {
            padding: 20px 24px;
        }

        /* ================= HEADER ================= */
        .report-header {
            display: block;
            margin-bottom: 14px;
            border-bottom: 2px solid #222;
            padding-bottom: 8px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin: 0;
            text-transform: uppercase;
        }

        .report-meta {
            margin-top: 4px;
            font-size: 9px;
            color: #555;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        thead th {
            background-color: #f3f4f6;
            border: 1px solid #333;
            padding: 6px 5px;
            font-size: 9px;
            text-align: center;
            text-transform: uppercase;
        }

        tbody td {
            border: 1px solid #444;
            padding: 5px 6px;
            font-size: 9px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        /* ================= SUMMARY ================= */
        .summary {
            margin-top: 14px;
            width: 100%;
            border: 1px solid #333;
            padding: 8px;
            font-size: 9px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .summary-row strong {
            font-weight: bold;
        }

        /* ================= FOOTER ================= */
        .footer {
            margin-top: 18px;
            font-size: 8px;
            color: #666;
            text-align: center;
            border-top: 1px solid #aaa;
            padding-top: 6px;
        }
    </style>
</head>
<body>
<div class="page">

    <!-- HEADER -->
    <div class="report-header">
        <h1 class="report-title">Laporan Semua Transaksi</h1>
        <div class="report-meta">
            Dicetak: {{ date('d-m-Y H:i:s') }} |
            Total Data: {{ count($records) }} transaksi
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        </thead>
        <tbody>
        @php
            $grandTotal = 0;
        @endphp

        @forelse($records as $record)
            @php
                $grandTotal += $record->jumlah_grandtotal ?? 0;
            @endphp
            <tr>
                <td>{{ $record->booking_trx_id ?? '-' }}</td>
                <td>{{ $record->nama ?? '-' }}</td>
                <td>{{ $record->produk->name ?? '-' }}</td>
                <td class="center">{{ (int) ($record->kuantitas ?? 0) }}</td>
                <td class="right">
                    Rp {{ number_format($record->produk->price ?? 0, 0, ',', '.') }}
                </td>
                <td class="right">
                    Rp {{ number_format($record->jumlah_subtotal ?? 0, 0, ',', '.') }}
                </td>
                <td class="right">
                    Rp {{ number_format($record->jumlah_grandtotal ?? 0, 0, ',', '.') }}
                </td>
                <td class="center">
                    {{ $record->is_paid ? 'LUNAS' : 'PENDING' }}
                </td>
                <td class="center">
                    {{ optional($record->created_at)->format('d-m-Y') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="center">Tidak ada data transaksi</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="summary">
        <div class="summary-row">
            <span>Total Transaksi</span>
            <strong>{{ count($records) }}</strong>
        </div>
        <div class="summary-row">
            <span>Total Nilai</span>
            <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Laporan ini dihasilkan secara otomatis oleh sistem — © {{ date('Y') }}
    </div>

</div>
</body>
</html>
