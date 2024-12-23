
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;

// Home
Route::get('/', [Controller::class, 'home'])->middleware('auth')->name('home');


// 

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rute untuk admin
Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/treatment', [Controller::class, 'treatment'])->name('treatment');
    Route::get('/addtreatment', [Controller::class, 'addtreatment'])->name('addtreatment');
    Route::post('/savetreatment', [Controller::class, 'savetreatment'])->name('savetreatment');
    Route::get('/edittreatment/{idTreatment}', [Controller::class, 'edittreatment'])->name('edittreatment');
    Route::post('/changetreatment', [Controller::class, 'changetreatment'])->name('changetreatment');
    //karyawan
    Route::get('/karyawan', [Controller::class, 'karyawan'])->name('karyawan');
    Route::get('/addkaryawan', [Controller::class, 'addkaryawan'])->name('addkaryawan');
    Route::post('/savekaryawan', [Controller::class, 'savekaryawan'])->name('savekaryawan');
    Route::get('/editkaryawan/{idKaryawan}', [Controller::class, 'editkaryawan'])->name('editkaryawan');
    Route::post('/changekaryawan', [Controller::class, 'changekaryawan'])->name('changekaryawan');
    Route::get('/resetkomisi', [Controller::class, 'resetkomisi'])->name('resetkomisi');
    //komisi
    Route::get('/komisi', [Controller::class, 'komisi'])->name('komisi');
    Route::get('/komisikaryawan/{idKaryawan}', [Controller::class, 'komisikaryawan'])->name('komisikaryawan');
    //penggajian
    Route::get('/gaji/{idKaryawan}', [Controller::class, 'gaji'])->name('gaji');
    //pdf
    Route::get('/slipgaji/{idKaryawan}', [Controller::class, 'slipgaji'])->name('slipgaji');
    //keuangan
    Route::get('/pemasukan', [Controller::class, 'pemasukan'])->name('pemasukan');
    Route::get('/pengeluaran', [Controller::class, 'pengeluaran'])->name('pengeluaran');

});

// Rute untuk transaksi (dapat diakses oleh admin dan karyawan)
Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/transaksi', [Controller::class, 'transaksi'])->name('transaksi');
    Route::get('/dataTransaksi', [Controller::class, 'dataTransaksi'])->name('dataTransaksi');
    Route::post('/savetransaksi', [Controller::class, 'savetransaksi'])->name('savetransaksi');
    Route::get('/detail/{idTransaksi}', [Controller::class, 'detail'])->name('detail');
    Route::get('/pdf/{idTransaksi}', [Controller::class, 'pdf'])->name('pdf');
});

// Admin Routes
// Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    
//     Route::get('/treatment', [Controller::class, 'treatment'])->name('treatment');
//     Route::get('/addtreatment', [Controller::class, 'addtreatment'])->name('addtreatment');
//     Route::post('/savetreatment', [Controller::class, 'savetreatment'])->name('savetreatment');
//     Route::get('/edittreatment/{idTreatment}', [Controller::class, 'edittreatment'])->name('edittreatment');
//     Route::post('/changetreatment', [Controller::class, 'changetreatment'])->name('changetreatment');
//     //karyawan
//     Route::get('/karyawan', [Controller::class, 'karyawan'])->name('karyawan');
//     Route::get('/addkaryawan', [Controller::class, 'addkaryawan'])->name('addkaryawan');
//     Route::post('/savekaryawan', [Controller::class, 'savekaryawan'])->name('savekaryawan');
//     Route::get('/editkaryawan/{idKaryawan}', [Controller::class, 'editkaryawan'])->name('editkaryawan');
//     Route::post('/changekaryawan', [Controller::class, 'changekaryawan'])->name('changekaryawan');
//     Route::get('/resetkomisi', [Controller::class, 'resetkomisi'])->name('resetkomisi');
//     //transaksi
//     Route::get('/transaksi', [Controller::class, 'transaksi'])->name("transaksi");
//     Route::get('/dataTransaksi', [Controller::class, 'dataTransaksi'])->name('dataTransaksi');
//     Route::post('/savetransaksi', [Controller::class, 'savetransaksi'])->name("savetransaksi");
//     //detailTransaksi
//     Route::get('/detail/{idTransaksi}', [Controller::class, 'detail'])->name('detail');
//     //komisi
//     Route::get('/komisi', [Controller::class, 'komisi'])->name('komisi');
//     Route::get('/komisikaryawan/{idKaryawan}', [Controller::class, 'komisikaryawan'])->name('komisikaryawan');
//     //penggajian
//     Route::get('/gaji/{idKaryawan}', [Controller::class, 'gaji'])->name('gaji');
//     //pdf
//     Route::get('/pdf/{idTransaksi}', [Controller::class, 'pdf'])->name('pdf');
//     Route::get('/slipgaji/{idKaryawan}', [Controller::class, 'slipgaji'])->name('slipgaji');
    
    
// });

// // Karyawan Routes
// Route::middleware(['auth', RoleMiddleware::class . ':karyawan'])->group(function () {
//     Route::get('/transaksi', [Controller::class, 'transaksi']);
//     Route::get('/dataTransaksi', [Controller::class, 'dataTransaksi']);
//     Route::post('/savetransaksi', [Controller::class, 'savetransaksi']);
//     Route::get('/detail/{idTransaksi}', [Controller::class, 'detail']);
//     Route::get('/pdf/{idTransaksi}', [Controller::class, 'pdf']);
// });