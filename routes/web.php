<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FactuurController;
use App\Http\Controllers\OfferteController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Afdelingsroutes (beschermd met auth)
Route::view('sales', 'sales.dashboard')->middleware('auth')->name('sales');
Route::view('purchasing', 'purchasing.dashboard')->middleware('auth')->name('purchasing');
Route::view('finance', 'finance.dashboard')->middleware('auth')->name('finance');
Route::view('technician', 'technician.dashboard')->middleware('auth')->name('technician');
Route::view('planner', 'planner.dashboard')->middleware('auth')->name('planner');
Route::view('admin', 'admin.dashboard-simple')->middleware('auth')->name('management');

// Sales Department
Route::view('sales', 'sales.dashboard')->middleware('auth')->name('sales.dashboard');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'goToEdit'])->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'edit'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');


Route::view('purchasing', 'purchasing.dashboard')->middleware('auth')->name('purchasing.dashboard');
Route::view('finance', 'finance.dashboard')->middleware('auth')->name('finance.dashboard');
Route::view('technician', 'technician.dashboard')->middleware('auth')->name('technician.dashboard');
Route::view('planner', 'planner.dashboard')->middleware('auth')->name('planner.dashboard');
Route::view('admin', 'admin.dashboard-new')->middleware('auth')->name('management.dashboard');

// Contract routes - alleen voor Finance en Admin
Route::get('/contracts', [ContractController::class, 'index'])->middleware('auth')->name('contracts.index');
Route::get('/contracts/create', [ContractController::class, 'create'])->middleware('auth')->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->middleware('auth')->name('contracts.store');
Route::get('/contracts/{id}', [ContractController::class, 'show'])->middleware('auth')->name('contracts.show');
Route::get('/contracts/{id}/pdf', [ContractController::class, 'downloadPdf'])->middleware('auth')->name('contracts.pdf');

// Offerte routes - alleen voor Sales en Management
Route::get('/offertes', [OfferteController::class, 'index'])->middleware('auth')->name('offertes.index');
Route::get('/offertes/create', [OfferteController::class, 'create'])->middleware('auth')->name('offertes.create');
Route::post('/offertes', [OfferteController::class, 'store'])->middleware('auth')->name('offertes.store');
Route::get('/offertes/{id}', [OfferteController::class, 'show'])->middleware('auth')->name('offertes.show');
Route::get('/offertes/{id}/edit', [OfferteController::class, 'edit'])->middleware('auth')->name('offertes.edit');
Route::put('/offertes/{id}', [OfferteController::class, 'update'])->middleware('auth')->name('offertes.update');
Route::get('/offertes/{id}/pdf', [OfferteController::class, 'downloadPdf'])->middleware('auth')->name('offertes.pdf');

// Factuur routes - alleen voor Finance en Management
Route::get('/facturen', [FactuurController::class, 'index'])->middleware('auth')->name('facturen.index');
Route::get('/facturen/create', [FactuurController::class, 'create'])->middleware('auth')->name('facturen.create');
Route::post('/facturen', [FactuurController::class, 'store'])->middleware('auth')->name('facturen.store');
Route::get('/facturen/{id}/edit', [FactuurController::class, 'edit'])->middleware('auth')->name('facturen.edit');
Route::put('/facturen/{id}', [FactuurController::class, 'update'])->middleware('auth')->name('facturen.update');
Route::get('/facturen/{id}/send', [FactuurController::class, 'send'])->middleware('auth')->name('facturen.send');
Route::post('/facturen/{id}/send', [FactuurController::class, 'sendEmail'])->middleware('auth')->name('facturen.sendEmail');
Route::get('/facturen/{id}/pdf', [FactuurController::class, 'downloadPdf'])->middleware('auth')->name('facturen.pdf');

// Geen afdeling
Route::view('none', 'none')->middleware('auth')->name('none');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
