<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FinanceController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('manger', function () {
    return view('manger');
})->name('students.manger');

Route::get('/thank-you', function () {
    return view('thank-you');
})->name('students.thankYou');


Route::get('/register', [StudentController::class, 'create'])->name('students.create');
Route::post('/register', [StudentController::class, 'store'])->name('students.store');

//admin
Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('/admin/requests', [StudentController::class, 'showRequests'])->name('admin.requests');
    Route::post('/students/accept/{id}', [StudentController::class, 'acceptStudent'])->name('students.accept');
    Route::post('/students/reject/{id}', [StudentController::class, 'rejectStudent'])->name('students.reject');
});
//finance

Route::get('/finance', [FinanceController::class, 'finance_admin'])
    ->name('finance.admin')
    ->middleware(\App\Http\Middleware\CheckFinance::class);;
Route::post('/finance/confirm/{id}', [FinanceController::class, 'confirmPayment'])->name('finance.confirm');


//setting
Route::get('/admin/dashboard', [StudentController::class, 'managerDashboard'])
    ->name('admin.dashboard')
    ->middleware('CheckAdmin');

Route::post('/admin/specializations', [StudentController::class, 'addSpecialization'])
    ->name('admin.specializations.store');

Route::get('/choose/{id}', [StudentController::class, 'show'])->name('student.show');

Route::get('/students/{id}/specializations', [StudentController::class, 'selectSpecializations'])->name('students.selectSpecializations');

Route::post('/students/add-specialization', [StudentController::class, 'addSpecialization'])->name('students.specializations.add');

Route::post('/students/remove-specialization', [StudentController::class, 'removeSpecialization'])->name('students.specializations.remove');
