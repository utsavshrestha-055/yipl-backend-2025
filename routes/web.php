<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BooksController;

Route::get('/', fn() => redirect('/authors-ui'));
Route::get('/authors-ui', [AuthorController::class, 'listUI'])->name('authors.ui');
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store'); // handles UI form submit
Route::get('/authors-ui/edit/{id}', [AuthorController::class, 'editUI'])->name('authors.edit');
Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
Route::get('/books-ui', [BooksController::class, 'listUI'])->name('books.ui');
Route::post('/books', [BooksController::class, 'store'])->name('books.store');
Route::get('/books-ui/edit/{id}', [BooksController::class, 'editUI'])->name('books.edit');
Route::put('/books/{id}', [BooksController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BooksController::class, 'destroy'])->name('books.destroy');
