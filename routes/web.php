<?php

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
Route::view('admin', 'admin.dashboard')->middleware('auth')->name('management');


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
