<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ExpenseFieldController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ReportsController;
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
Route::resource('/supervisors', SupervisorController::class);

Route::get('/Home', [MemberController::class, 'master'])->name('home');

Route::prefix('reports/')->name('reports.')->group(function () {
    Route::get('members', [ReportsController::class, 'members'])->name('members');
    Route::get('members/subscribes/{id}', [ReportsController::class, 'membersSubscribes'])->name('members.Subscribes');
    Route::get('investments', [ReportsController::class, 'investments'])->name('investment');
    Route::get('expenses', [ReportsController::class, 'expenses'])->name('expenses');
    Route::get('supervisors', [ReportsController::class, 'supervisors'])->name('supervisors');
});
