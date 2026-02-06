<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DesignationController;
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


    //** Payroll Routes start **//
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll/store', [PayrollController::class, 'store'])->name('payroll.store');

    // Datatable + stats
    Route::get('/payroll/data', [PayrollController::class, 'getPayrollData'])->name('payroll.data');
    Route::get('/payroll/stats', [PayrollController::class, 'getStats'])->name('payroll.stats');

    // Filters
    Route::get('/payroll/employees', [PayrollController::class, 'getEmployees'])->name('payroll.employees');

    // Single payroll
    Route::get('/payroll/{id}/details', [PayrollController::class, 'getPayrollDetails'])->name('payroll.details');
    Route::put('/payroll/{id}/status', [PayrollController::class, 'updateStatus'])->name('payroll.updateStatus');
    Route::delete('/payroll/{id}', [PayrollController::class, 'destroy'])->name('payroll.destroy');

    // Bulk actions
    Route::post('/payroll/bulk/status', [PayrollController::class, 'bulkUpdateStatus'])->name('payroll.bulkStatus');
    Route::post('/payroll/bulk/delete', [PayrollController::class, 'bulkDelete'])->name('payroll.bulkDelete');

    // Payslip
    Route::get('/payroll/{id}/payslip', [PayrollController::class, 'downloadPayslip'])->name('payroll.payslip');

    // Edit / update
    Route::get('/payroll/{id}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::put('/payroll/{id}', [PayrollController::class, 'update'])->name('payroll.update');
    //** Payroll Routes end **//


    // Reports Routes
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/data', [ReportController::class, 'getReportData'])->name('report.data');
    Route::get('/report/export/pdf', [ReportController::class, 'exportPDF'])->name('report.export.pdf');
    Route::get('/report/export/csv', [ReportController::class, 'exportCSV'])->name('report.export.csv');

    // Department Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/datatable', [DepartmentController::class, 'datatable'])->name('departments.datatable');

    // Designation Routes
    Route::get('/designation', [DesignationController::class, 'index'])->name('designation.index');
    Route::get('/designation/datatable', [DesignationController::class, 'datatable'])->name('designation.datatable');


    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
