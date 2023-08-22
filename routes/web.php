<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ExpenseFieldController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\InvestmentController;
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

Route::resource('/members', MemberController::class);
Route::resource('/subscribes', SubscribeController::class);
Route::resource('/investments', InvestmentController::class);
Route::resource('/expenses', ExpensesController::class);
Route::resource('/expense_fields', ExpenseFieldController::class);


Route::get('', [MemberController::class, 'master'])->name('home');
