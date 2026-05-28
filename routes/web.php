<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () { return redirect()->route('login'); });

Route::middleware(['auth', 'verified'])->group(function () {
// Taruh di dalam group middleware auth agar aman
Route::post('/upload-product-image', [ProductController::class, 'uploadImage'])->name('product.upload');
    
    // DASHBOARD UTAMA (POP KAYU)
    Route::get('/dashboard', function () {
        return view('dashboard', ['type' => 'kayu']); 
    })->name('dashboard');

    // --- ROUTE FITUR BARU ---
    // Semua fitur diarahkan ke dashboard dengan membawa 'type' masing-masing
    
    Route::get('/pop-a3-led', function () { 
        return view('dashboard', ['type' => 'a3-led']); 
    })->name('pop.a3');

    Route::get('/nama-buah', function () { 
        return view('dashboard', ['type' => 'buah']); 
    })->name('pop.buah');

    Route::get('/pop-acrylic', function () { 
        return view('dashboard', ['type' => 'acrylic']); 
    })->name('pop.acrylic');

    Route::get('/history', function () { 
        return view('history'); 
    })->name('history');

    Route::get('/register', function () {
        return view('dashboard', ['type' => 'register']);
    })->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // --- API & DATA ---
    Route::get('/api/labels', [LabelController::class, 'index']);
    Route::post('/api/labels/sync', [LabelController::class, 'store']);
    Route::post('/api/labels/save-single', [LabelController::class, 'saveSingle']);
    Route::delete('/api/labels/{id}', [LabelController::class, 'destroy']);
    Route::post('/api/labels/clear-all', [LabelController::class, 'destroyAll']);

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sop-visual', function () { 
    return view('dashboard', ['type' => 'sop-visual']); 
})->name('sop.visual');
});

require __DIR__.'/auth.php';