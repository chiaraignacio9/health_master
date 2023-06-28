<?php

use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PrepagasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TurnosController;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome', [
        'doctores' => DB::select('SELECT doctores.*, users.*, doctor_especialidades.nombre AS especialidad FROM doctores
                                INNER JOIN users ON users.id = doctores.user_id
                                INNER JOIN doctor_especialidades ON doctores.especialidad_id = doctor_especialidades.id
                                ')
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

Route::prefix('/admin')->group(function () {
    Route::resource('pacientes', PacientesController::class)->middleware('auth');
    Route::get('paciente/eliminados', [PacientesController::class, 'eliminados'])->middleware(['auth'])->name('pacientes.eliminados');
    Route::resource('doctores', DoctoresController::class)->middleware('auth');
    Route::get('doctores/eliminados', [DoctoresController::class, 'eliminados'])->middleware(['auth'])->name('doctores.eliminados');
    Route::resource('prepagas', PrepagasController::class)->middleware('auth');
    Route::resource('turnos', TurnosController::class)->middleware('auth');
});

Route::get('/historial', [PacientesController::class, 'verHistorial'])->name('paciente.historial')->middleware(['auth', 'paciente']);

Route::get('/admin/prepagas/eliminadas', [PrepagasController::class, 'create'])->name('prepaga.demo');

require __DIR__ . '/auth.php';
