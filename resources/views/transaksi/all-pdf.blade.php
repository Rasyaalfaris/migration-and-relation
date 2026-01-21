<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Laporan Transaksi</title>
    <h1>LAPORAN SEMUA TRANSAKSI</h1>
    <p>Tanggal: {{ date('d-m-Y H:i:s') }} | Total: {{ count($record) }} transaksi</p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tgl</th>
            </tr>
        </thead>
        <tbody>
            @forelse($record as $t)
            <tr>
                <td>{{ isset($t->booking_trx_id) ? trim($t->booking_trx_id) : '-' }}</td>
                <td>{{ isset($t->nama) ? trim($t->nama) : '-' }}</td>
                <td>{{ isset($t->produk->name) ? trim($t->produk->name) : '-' }}</td>
                <td style="text-align: center;">{{ isset($t->kuantitas) ? intval($t->kuantitas) : 0 }}</td>
                <td style="text-align: right;">Rp {{ number_format(floatval($t->jumlah_grandtotal), 0, ',', '.') }}</td>
                <td>{{ $t->is_paid ? 'BAYAR' : 'BELUM' }}</td>
                <td>{{ isset($t->created_at) ? date('d-m-Y', strtotime($t->created_at)) : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <?php
        $totalPendapatan = 0;
        $totalDibayar = 0;
        foreach($transaksis as $item) {
            $totalPendapatan += floatval($item->jumlah_grandtotal);
            if($item->is_paid) $totalDibayar++;
        }
        $totalBelum = count($transaksis) - $totalDibayar;
    ?>
    
    <div class="summary">
        <strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 0, ',', '.') }}<br>
        <strong>Transaksi Dibayar:</strong> {{ $totalDibayar }}<br>
        <strong>Transaksi Belum Dibayar:</strong> {{ $totalBelum }}
    </div>
    
    <p style="font-size: 9px; text-align: center; margin-top: 20px;">Laporan otomatis - Hak Cipta {{ date('Y') }}</p>
</body>
</html>