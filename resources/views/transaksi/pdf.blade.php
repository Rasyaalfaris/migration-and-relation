@extend('layout.main')
@section('content')
    <title>Laporan Transaksi</title>
    <h1>LAPORAN TRANSAKSI</h1>
    <p>Tanggal: {{ date('d-m-Y H:i:s') }}</p>
    
    <div class="section">
        <h3>Informasi Pelanggan</h3>
        <table>
            <tr>
                <td class="label">Nama</td>
                <td>{{ isset($transaksi->nama) ? trim($transaksi->nama) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>{{ isset($transaksi->email) ? trim($transaksi->email) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Telepon</td>
                <td>{{ isset($transaksi->telepon) ? trim($transaksi->telepon) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kota</td>
                <td>{{ isset($transaksi->kota) ? trim($transaksi->kota) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kode Pos</td>
                <td>{{ isset($transaksi->kode_pos) ? trim($transaksi->kode_pos) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td>{{ isset($transaksi->alamat) ? trim($transaksi->alamat) : '-' }}</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Informasi Transaksi</h3>
        <table>
            <tr>
                <td class="label">ID Transaksi</td>
                <td>{{ isset($transaksi->booking_trx_id) ? trim($transaksi->booking_trx_id) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Produk</td>
                <td>{{ isset($transaksi->produk->name) ? trim($transaksi->produk->name) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Ukuran</td>
                <td>{{ isset($transaksi->produk_size) ? trim($transaksi->produk_size) : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kuantitas</td>
                <td>{{ isset($transaksi->kuantitas) ? intval($transaksi->kuantitas) : 0 }}</td>
            </tr>
            <tr>
                <td class="label">Status Pembayaran</td>
                <td>{{ $transaksi->is_paid ? 'DIBAYAR' : 'BELUM DIBAYAR' }}</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Detail Pembayaran</h3>
        <table>
            <tr>
                <td class="label">Subtotal</td>
                <td style="text-align: right;">Rp {{ number_format(floatval($transaksi->jumlah_subtotal), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total</td>
                <td style="text-align: right;">Rp {{ number_format(floatval($transaksi->jumlah_grandtotal), 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <p style="font-size: 10px; text-align: center;">Laporan ini dihasilkan otomatis dari sistem.</p>
    </div>
</body>
</html>
@endsection