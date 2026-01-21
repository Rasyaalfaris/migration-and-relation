<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111827;
            line-height: 1.6;
        }

        .page {
            padding: 28px;
        }

        /* ===== Header ===== */
        .header {
            width: 100%;
            margin-bottom: 24px;
        }

        .header td {
            vertical-align: top;
        }

        .company {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 10px;
            color: #6b7280;
        }

        .doc-meta {
            text-align: right;
            font-size: 10px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
        }

        .paid {
            background: #dcfce7;
            color: #166534;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        /* ===== Divider ===== */
        .divider {
            border-bottom: 3px solid #111827;
            margin: 12px 0 24px;
        }

        /* ===== Card ===== */
        .card {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 18px;
        }

        .card-title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
            border-left: 4px solid #111827;
            padding-left: 8px;
        }

        /* ===== Info Table ===== */
        table.info {
            width: 100%;
            border-collapse: collapse;
        }

        table.info td {
            padding: 6px 4px;
            font-size: 11px;
        }

        table.info td.label {
            width: 35%;
            font-weight: bold;
            color: #374151;
        }

        /* ===== Product Table ===== */
        table.detail {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.detail th {
            background: #111827;
            color: #fff;
            padding: 8px;
            font-size: 11px;
            text-align: left;
        }

        table.detail td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }

        table.detail tr:nth-child(even) {
            background: #f9fafb;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        /* ===== Summary ===== */
        .summary-wrapper {
            width: 100%;
            margin-top: 20px;
        }

        table.summary {
            width: 40%;
            margin-left: auto;
            border-collapse: collapse;
        }

        table.summary td {
            padding: 6px 8px;
            font-size: 11px;
        }

        table.summary td.label {
            font-weight: bold;
            color: #374151;
        }

        table.summary tr.total td {
            font-size: 13px;
            font-weight: bold;
            border-top: 3px solid #111827;
            border-bottom: 3px solid #111827;
            padding: 10px 8px;
        }

        /* ===== Footer ===== */
        .footer {
            margin-top: 32px;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>

<body>
<div class="page">

    <!-- Header -->
    <table class="header">
        <tr>
            <td>
                <div class="company">LAPORAN TRANSAKSI</div>
                <div class="subtitle">Dokumen Resmi Penjualan</div>
            </td>
            <td class="doc-meta">
                <div>No: <strong>{{ $record->booking_trx_id }}</strong></div>
                <div>{{ now()->format('d M Y H:i') }}</div>
                <div style="margin-top:6px">
                    <span class="badge {{ $record->is_paid ? 'paid' : 'pending' }}">
                        {{ $record->is_paid ? 'PAID' : 'PENDING' }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Customer Info -->
    <div class="card">
        <div class="card-title">Informasi Pelanggan</div>
        <table class="info">
            <tr><td class="label">Nama</td><td>{{ $record->nama ?? '-' }}</td></tr>
            <tr><td class="label">Email</td><td>{{ $record->email ?? '-' }}</td></tr>
            <tr><td class="label">Telepon</td><td>{{ $record->telepon ?? '-' }}</td></tr>
            <tr><td class="label">Alamat</td><td>{{ $record->alamat ?? '-' }}</td></tr>
        </table>
    </div>

    <!-- Product -->
    <div class="card">
        <div class="card-title">Detail Produk</div>
        <table class="detail">
            <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th class="center">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>{{ $record->produk->name ?? '-' }}</td>
                <td class="center">{{ $record->kuantitas }}</td>
                <td class="right">Rp {{ number_format($record->produk->price,0,',','.') }}</td>
                <td class="right">
                    Rp {{ number_format($record->produk->price * $record->kuantitas,0,',','.') }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="summary-wrapper">
        <table class="summary">
            <tr>
                <td class="label">Subtotal</td>
                <td class="right">Rp {{ number_format($record->jumlah_subtotal,0,',','.') }}</td>
            </tr>
            <tr class="total">
                <td class="label">TOTAL</td>
                <td class="right">Rp {{ number_format($record->jumlah_grandtotal,0,',','.') }}</td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen ini dihasilkan otomatis oleh sistem — © {{ date('Y') }}
    </div>

</div>
</body>
</html>
