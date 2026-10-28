<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Dashboards
    Route::get('/dashboard/client', [DashboardController::class, 'client'])->name('dashboard.client');
    Route::get('/dashboard/prestataire', [DashboardController::class, 'prestataire'])->name('dashboard.prestataire');

    // Services — export PDF AVANT resource pour éviter le conflit
    Route::get('/services/export-pdf', [ServiceController::class, 'exportPdf'])->name('services.export.pdf');
    Route::resource('services', ServiceController::class);

    // Demandes
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
    Route::patch('/demandes/{demande}/statut', [DemandeController::class, 'updateStatut'])->name('demandes.statut');
    Route::get('/demandes/recues', [DemandeController::class, 'demandesRecues'])->name('demandes.recues');
    Route::get('/demandes/envoyees', [DemandeController::class, 'demandesEnvoyees'])->name('demandes.envoyees');

    // Messages / Chat
    Route::get('/demandes/{demande}/chat', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/demandes/{demande}/messages', [MessageController::class, 'store'])->name('messages.store');

    // Avis
    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');

    // Notifications
    Route::get('/notifications/lire', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Notifications marquées comme lues.');
    })->name('notifications.lire');

});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::patch('/services/{service}/toggle', [AdminController::class, 'toggleService'])->name('admin.services.toggle');
    Route::delete('/services/{service}', [AdminController::class, 'deleteService'])->name('admin.services.delete');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategorie'])->name('admin.categories.store');
    Route::delete('/categories/{categorie}', [AdminController::class, 'deleteCategorie'])->name('admin.categories.delete');
});

Route::delete('/service-images/{image}', [ServiceController::class, 'destroyImage'])->name('service-images.destroy');

require __DIR__.'/auth.php';