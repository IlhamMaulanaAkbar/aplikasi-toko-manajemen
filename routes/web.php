<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Master\JenisBarangController;
use App\Http\Controllers\Master\SatuanBarangController;
use App\Http\Controllers\Master\ProdukBatchController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Transaksi\BarangExpiredController;
use App\Http\Controllers\Transaksi\BarangKeluarController;
use App\Http\Controllers\Transaksi\BarangMasukController;
use App\Http\Controllers\Transaksi\PermintaanBarangController;
use App\Http\Controllers\Transaksi\ReturBarangController;
use App\Http\Controllers\Transaksi\StokOpnameController;
use App\Http\Controllers\Laporan\ProdukController as LaporanProdukController;
use App\Http\Controllers\Laporan\BarangMasukController as LaporanBarangMasukController;
use App\Http\Controllers\Laporan\BarangKeluarController as LaporanBarangKeluarController;
use App\Http\Controllers\Laporan\BarangExpiredController as LaporanBarangExpiredController;
use App\Http\Controllers\Laporan\PermintaanBarangController as LaporanPermintaanBarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/produk/{produk}/batch', [ProdukBatchController::class, 'index'])->name('produk-batch.index');
    Route::get('/produk/{produk}/batch/create', [ProdukBatchController::class, 'create'])->name('produk-batch.create');
    Route::post('/produk/{produk}/batch', [ProdukBatchController::class, 'store'])->name('produk-batch.store');
    Route::get('/produk/batch/{batch}/edit', [ProdukBatchController::class, 'edit'])->name('produk-batch.edit');
    Route::put('/produk/batch/{batch}', [ProdukBatchController::class, 'update'])->name('produk-batch.update');
    Route::delete('/produk/batch/{batch}', [ProdukBatchController::class, 'destroy'])->name('produk-batch.destroy');

    Route::get('/jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
    Route::get('/jenis-barang/create', [JenisBarangController::class, 'create'])->name('jenis-barang.create');
    Route::post('/jenis-barang', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
    Route::get('/jenis-barang/{jenisBarang}', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
    Route::put('/jenis-barang/{jenisBarang}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
    Route::delete('/jenis-barang/{jenisBarang}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');

    Route::get('/satuan-barang', [SatuanBarangController::class, 'index'])->name('satuan-barang.index');
    Route::get('/satuan-barang/create', [SatuanBarangController::class, 'create'])->name('satuan-barang.create');
    Route::post('/satuan-barang', [SatuanBarangController::class, 'store'])->name('satuan-barang.store');
    Route::get('/satuan-barang/{satuanBarang}', [SatuanBarangController::class, 'edit'])->name('satuan-barang.edit');
    Route::put('/satuan-barang/{satuanBarang}', [SatuanBarangController::class, 'update'])->name('satuan-barang.update');
    Route::delete('/satuan-barang/{satuanBarang}', [SatuanBarangController::class, 'destroy'])->name('satuan-barang.destroy');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{supplier}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::get('/barang-masuk/{barangMasuk}', [BarangMasukController::class, 'edit'])->name('barang-masuk.edit');
    Route::put('/barang-masuk/{barangMasuk}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
    Route::delete('/barang-masuk/{barangMasuk}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');

    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    Route::get('/barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'edit'])->name('barang-keluar.edit');
    Route::put('/barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update');
    Route::delete('/barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');

    Route::get('/barang-expired', [BarangExpiredController::class, 'index'])->name('barang-expired.index');
    Route::get('/barang-expired/create', [BarangExpiredController::class, 'create'])->name('barang-expired.create');
    Route::post('/barang-expired', [BarangExpiredController::class, 'store'])->name('barang-expired.store');
    Route::get('/barang-expired/{barangExpired}', [BarangExpiredController::class, 'edit'])->name('barang-expired.edit');
    Route::put('/barang-expired/{barangExpired}', [BarangExpiredController::class, 'update'])->name('barang-expired.update');
    Route::delete('/barang-expired/{barangExpired}', [BarangExpiredController::class, 'destroy'])->name('barang-expired.destroy');

    Route::get('/stok-opname', [StokOpnameController::class, 'index'])->name('stok-opname.index');
    Route::get('/stok-opname/create', [StokOpnameController::class, 'create'])->name('stok-opname.create');
    Route::post('/stok-opname', [StokOpnameController::class, 'store'])->name('stok-opname.store');
    Route::get('/stok-opname/{stokOpname}', [StokOpnameController::class, 'edit'])->name('stok-opname.edit');
    Route::put('/stok-opname/{stokOpname}', [StokOpnameController::class, 'update'])->name('stok-opname.update');
    Route::delete('/stok-opname/{stokOpname}', [StokOpnameController::class, 'destroy'])->name('stok-opname.destroy');

    Route::get('/retur-barang', [ReturBarangController::class, 'index'])->name('retur-barang.index');
    Route::get('/retur-barang/create', [ReturBarangController::class, 'create'])->name('retur-barang.create');
    Route::post('/retur-barang', [ReturBarangController::class, 'store'])->name('retur-barang.store');
    Route::get('/retur-barang/{returBarang}', [ReturBarangController::class, 'edit'])->name('retur-barang.edit');
    Route::put('/retur-barang/{returBarang}', [ReturBarangController::class, 'update'])->name('retur-barang.update');
    Route::delete('/retur-barang/{returBarang}', [ReturBarangController::class, 'destroy'])->name('retur-barang.destroy');

    Route::get('/permintaan-barang', [PermintaanBarangController::class, 'index'])->name('permintaan-barang.index');
    Route::get('/permintaan-barang/create', [PermintaanBarangController::class, 'create'])->name('permintaan-barang.create');
    Route::post('/permintaan-barang', [PermintaanBarangController::class, 'store'])->name('permintaan-barang.store');
    Route::get('/permintaan-barang/{permintaanBarang}', [PermintaanBarangController::class, 'edit'])->name('permintaan-barang.edit');
    Route::put('/permintaan-barang/{permintaanBarang}', [PermintaanBarangController::class, 'update'])->name('permintaan-barang.update');
    Route::delete('/permintaan-barang/{permintaanBarang}', [PermintaanBarangController::class, 'destroy'])->name('permintaan-barang.destroy');
    Route::get(
        '/permintaan-barang/{permintaanBarang}/pdf',
        [PermintaanBarangController::class, 'generatePdf']
    )->name('permintaan-barang.pdf');

    Route::middleware(['check.role:Manajer Toko,Super Admin'])->group(function () {
        Route::post('permintaan-barang/{permintaanBarang}/approve', [PermintaanBarangController::class, 'approve'])->name('permintaan-barang.approve');
        Route::post('permintaan-barang/{permintaanBarang}/reject', [PermintaanBarangController::class, 'reject'])->name('permintaan-barang.reject');
    });

    Route::middleware(['check.role:Super Admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::get('laporan-produk', [LaporanProdukController::class, 'index'])->name('laporan.produk.index');
    Route::get('laporan-produk/print', [LaporanProdukController::class, 'print'])->name('laporan.produk.print');
    Route::get('laporan-barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('laporan.barang-masuk.index');
    Route::get('laporan-barang-masuk/print', [LaporanBarangMasukController::class, 'print'])->name('laporan.barang-masuk.print');
    Route::get('laporan-barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan.barang-keluar.index');
    Route::get('laporan-barang-keluar/print', [LaporanBarangKeluarController::class, 'print'])->name('laporan.barang-keluar.print');
    Route::get('laporan-barang-expired', [LaporanBarangExpiredController::class, 'index'])->name('laporan.barang-expired.index');
    Route::get('laporan-barang-expired/print', [LaporanBarangExpiredController::class, 'print'])->name('laporan.barang-expired.print');
    Route::get('laporan-permintaan-barang', [LaporanPermintaanBarangController::class, 'index'])->name('laporan.permintaan-barang.index');
    Route::get('laporan-permintaan-barang/print', [LaporanPermintaanBarangController::class, 'print'])->name('laporan.permintaan-barang.print');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
