<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\ProdukTransaksi;

// Route::middleware('guest')->group(function (){
// Route::get('/', [AuthController::class, 'login'])->name('login');
// Route::post('/', [AuthController::class, 'store'])->name('login.store');
// });
Route::get('/transaksi/pdf/{id}', function ($id) {
    $record = ProdukTransaksi::findOrFail($id);
    $pdf = Pdf::loadView('transaksi.pdf', [
        'record' => $record,
    ]);

    return $pdf->download(
        "laporan-transaksi-{$record->id}.pdf"
    );

})->name('transaksi.pdf');
Route::get('/transaksi/preview{id}', function ($id) {
    $record = ProdukTransaksi::findOrFail($id);
    return view('transaksi.preview', compact('record'));
})->name('preview_transaksi.pdf');
Route::get('/transaksi/all-pdf', function (){
    $records = ProdukTransaksi::all();
    $pdf = Pdf::loadView('transaksi.all-pdf', [
        'records' => $records,
    ]);

    return $pdf->download(
        "laporan-semua-transaksi.pdf"
    );
})->name('print_all.pdf');

