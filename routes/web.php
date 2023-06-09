<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pappers\JournalController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Pappers\TransactionController;
use App\Http\Controllers\Pappers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

# Home
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'permission', 'verified'])->group(function () {
  # Setting menu
  Route::prefix('settings')->group(function () {
    # Role & permission
    Route::resource('roles', RoleController::class)->except('show');

    # User management password
    Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
    Route::post('users/password', [PasswordController::class, 'store']);

    # User management
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::resource('users', UserController::class);
  });

  # Pappers
  Route::prefix('pappers')->group(function () {
    Route::resource('transactions', TransactionController::class)->except('edit');
    Route::resource('registrations', RegistrationController::class)->except('show');
    Route::resource('journals', JournalController::class)->except('edit', 'update');
  });
});
