<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('books.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);
    Route::get('books-read', [BookController::class, 'readBooks'])->name('books.read');
    Route::patch('books/{book}/toggle', [BookController::class, 'toggleReadStatus'])->name('books.toggleReadStatus');
    Route::get('books/{book}/show', [BookController::class, 'show'])->name('books.show');
});

require __DIR__.'/auth.php';
