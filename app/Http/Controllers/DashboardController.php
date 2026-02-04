<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payroll;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Get statistics for the dashboard
        $totalEmployees = Employee::where('employment_status', 'active')->count();
        $totalDepartments = Department::where('status', 'active')->count();
        
        // Get today's attendance
        $today = Carbon::today();
        $presentToday = Attendance::whereDate('date', $today)
            ->where('status', 'present')
            ->count();
        
        // Get pending leaves
        $pendingLeaves = Leave::where('status', 'pending')->count();
        
        // Get recent employees
        $recentEmployees = Employee::with(['department', 'designation'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get recent leaves
        $recentLeaves = Leave::with(['employee', 'leaveType'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get attendance summary for the month
        $currentMonth = Carbon::now()->month;
        $attendanceSummary = Attendance::selectRaw('status, COUNT(*) as count')
            ->whereMonth('date', $currentMonth)
            ->groupBy('status')
            ->get();
        
        // Get upcoming birthdays
        $upcomingBirthdays = Employee::whereMonth('date_of_birth', '>=', Carbon::now()->month)
            ->whereDay('date_of_birth', '>=', Carbon::now()->day)
            ->orderByRaw('MONTH(date_of_birth), DAY(date_of_birth)')
            ->limit(5)
            ->get();
        
        return view('dashboard.index', compact(
            'totalEmployees',
            'totalDepartments',
            'presentToday',
            'pendingLeaves',
            'recentEmployees',
            'recentLeaves',
            'attendanceSummary',
            'upcomingBirthdays'
        ));
    }
}