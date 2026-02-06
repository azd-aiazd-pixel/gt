<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ParticipantController;



Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



    Route::middleware('admin')      
        ->prefix('admin')           
        ->name('admin.')            
        ->group(function () {
            
            Route::get('/dashboard', function () {return view('admin.dashboard'); })->name('dashboard'); 
            Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');

            // Fiche détaillée d'un participant
            Route::get('/participants/{participant}', [ParticipantController::class, 'show'])->name('participants.show');
            
            // Formulaire de modification (pour NFC ou Solde)
            Route::get('/participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
            
            // Mise à jour des données
            Route::put('/participants/{participant}', [ParticipantController::class, 'update'])->name('participants.update');

    });

  
    Route::middleware('store')
        ->prefix('store')
        ->name('store.')
        ->group(function () {
            
            Route::get('/dashboard', function () { return view('store.dashboard');})->name('dashboard');
    });


    Route::middleware('participant') 
         ->name('participant.')
        ->group(function () {

            Route::get('/dashboard', function () {return view('participant.dashboard');  })->name('dashboard');


    });







});