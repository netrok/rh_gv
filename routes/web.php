<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Empleados\Index;
use App\Livewire\Dashboard\Index as DashboardIndex;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí definimos todas las rutas del sistema.
*/

// Página de inicio
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard general
Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de configuración del usuario (autenticado)
Route::middleware(['auth'])->group(function () {
    Route::redirect('/settings', '/settings/profile');

    Route::get('/settings/profile', Profile::class)->name('settings.profile');
    Route::get('/settings/password', Password::class)->name('settings.password');
    Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');
});

// Rutas protegidas para RRHH y SuperAdmin
Route::middleware(['auth', 'verified', 'role:SuperAdmin,RRHH'])->group(function () {
    Route::get('/empleados', Index::class)->name('empleados.index');
});

Route::middleware(['auth', 'verified', 'role:SuperAdmin,RRHH'])->group(function () {
    Route::get('/dashboard-rh', DashboardIndex::class)->name('dashboard.rh');
});

// Rutas de autenticación (Login, Register, etc.)
require __DIR__ . '/auth.php';
