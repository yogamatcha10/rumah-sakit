<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DepartementController;
use App\Models\Position;
use App\Models\User;
use App\Models\Departement;
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
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name(
    'login.action'
);
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name(
    'password.action'
);
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::resource('positions', PositionController::class);
    Route::resource('departements', DepartementController::class);
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

Route::get('/', function () {
    $totaldata = App\Models\User::count();
    $totaldataposition = App\Models\Position::count();
    $totaldatadepartement = App\Models\Departement::count();
    return view(
        'dashboard',
        ['title' => 'Dashboard'],
        compact('totaldata', 'totaldatadepartement', 'totaldataposition')
    );
});
