<?php

use App\Http\Controllers\RSAController;
use App\Livewire\ExpenseGroup;
use App\Livewire\GroupAdd;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/addGroup', function () {
        return view('dashboard.AddGroup');
    })->name('addGroup');
    Route::get('/Group', function () {
        return view('dashboard.Group');
    })->name('Group');
    Route::get('/Expense', function () {
        return view('dashboard.Expense');
    })->name('Expense');
    Route::get('/addExpense', function () {
        return view('dashboard.AddExpense');
    })->name('addExpense');
    Route::get('/{groupId}/showExpense',ExpenseGroup::class )->name('ExpenseGroup');

});

Route::get('/RSA',[RSAController::class,'RSA']);
