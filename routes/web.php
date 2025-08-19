<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Team management routes
    Route::resource('teams', TeamController::class)->except(['show']);
    Route::get('teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    
    // Team switching
    Route::post('teams/{team}/switch', [TeamController::class, 'switchTeam'])
        ->name('teams.switch');
        
    // Team member management
    Route::post('teams/{team}/members', [TeamController::class, 'inviteMember'])
        ->name('teams.members.invite');
    Route::put('teams/{team}/members/{member}/role', [TeamController::class, 'updateMemberRole'])
        ->name('teams.members.role');
    Route::delete('teams/{team}/members/{member}', [TeamController::class, 'removeMember'])
        ->name('teams.members.remove');
});

require __DIR__.'/auth.php';
