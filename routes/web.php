<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Public Routes (No Authentication Required)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');


// Authentication Routes (Keep these before auth middleware)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');


Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employee Management
    Route::resource('employees', EmployeeController::class);
    Route::post('employees/datatable', [EmployeeController::class, 'datatable'])->name('employees.datatable');
    Route::post('/employees/save', [EmployeeController::class, 'save'])->name('employees.save');
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::get('employees/{employee}/profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::post('employees/{employee}/status', [EmployeeController::class, 'updateStatus'])->name('employees.status');
    
    // Department Routes
    Route::resource('departments', DepartmentController::class);
    
    // Attendance Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/datatable', [AttendanceController::class, 'datatable'])->name('attendance.datatable');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    
    // Leave Routes
    Route::resource('leaves', LeaveController::class)->except(['store']);
    Route::post('leaves/datatable', [LeaveController::class, 'datatable'])->name('leaves.datatable');
    Route::post('leave-types', [LeaveController::class, 'leaveTypes'])->name('leaves.types');
    Route::post('leaves-store', [LeaveController::class, 'store'])->name('leaves.store');
    Route::post('leaves-approve-reject', [LeaveController::class, 'approveReject'])->name('leaves.approveReject');

    // Payroll Routes
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/generate', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/{payroll}/payslip', [PayrollController::class, 'payslip'])->name('payroll.payslip');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
