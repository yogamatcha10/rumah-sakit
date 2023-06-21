<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\UserDController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Models\Position;
use App\Models\User;
use App\Models\Departement;
use App\Models\Obat;
use App\Models\Dokter;
use App\Models\Resep;
use App\Models\ResepDetail;
use Dompdf\Dompdf;

//untuk mendaftarkan routes masing-masing

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//untuk mendaftarkan link website

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name(
    'register.action'
);
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name(
    'login.action'
);
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name(
    'password.action'
);
Route::get('report', [ReportController::class, 'report'])->name('report');
Route::post('generate', [ReportController::class, 'generate'])->name(
    'generate'
);

Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/dashboard', function () {
    $totaldata = App\Models\User::count();
    $totaldataposition = App\Models\Position::count();
    $totaldatadepartement = App\Models\Departement::count();
    return view(
        'dashboard',
        ['title' => 'Dashboard'],
        compact('totaldata', 'totaldatadepartement', 'totaldataposition')
    );
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totaldata = App\Models\User::count();
        $totaldataposition = App\Models\Position::count();
        $totaldatadepartement = App\Models\Departement::count();
        return view(
            'dashboard',
            ['title' => 'Dashboard'],
            compact('totaldata', 'totaldatadepartement', 'totaldataposition')
        );
    })->middleware('auth');


    Route::resource('positions', PositionController::class);
    Route::resource('users', UserDController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('dokters', DokterController::class);
    Route::resource('obats', ObatController::class);
    Route::get('departement/exportPdf', [
        DepartementController::class,
        'exportPdf',
    ])->name('exportPdf');
    Route::get('position/export-excel', [
        PositionController::class,
        'exportExcel',
    ])->name('positions.exportExcel');

    // BIKIN SEARCH
    Route::get('search/obat', [
        ObatController::class,
        'autocomplete',
    ])->name('search.obat');

    // CHART
    Route::get('chart-line', [DokterController::class, 'chartLine'])->name('dokters.chartLine');
    Route::get('chart-line-ajax', [DokterController::class, 'chartLineAjax'])->name('dokters.chartLineAjax');
});
Route::get('report', function () {
    $departements = App\Models\Departement::all();

    return view('departements/report', compact('departements'));
});
Route::post('report/generate', function () {
    $departements = App\Models\Departement::all();

    $pdf = new Dompdf();
    $pdf->loadHtml(view('departements/report', compact('departements')));
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();

    return $pdf->stream('departement_report.pdf');
});
