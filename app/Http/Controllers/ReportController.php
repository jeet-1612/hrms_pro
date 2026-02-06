<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function getReportData(Request $request)
    {
        $reportType = $request->input('report_type', 'payroll');
        $dateRange = $request->input('date_range', 'this_month');
        $department = $request->input('department', 'all');

        // Simulated data - Replace with actual database queries
        $data = $this->generateSampleData($reportType);

        return response()->json([
            'data' => $data,
            'total' => count($data),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data)
        ]);
    }

    private function generateSampleData($reportType)
    {
        $data = [];
        $departments = ['Information Technology', 'Human Resources', 'Finance', 'Sales', 'Marketing'];
        // $departments = Department::where('status', 'active')->get();
        // $employees = Employee::orderBy('first_name')->get();
        $statuses = ['Paid', 'Pending', 'Processing'];
        
        for ($i = 1; $i <= 20; $i++) {
            $baseSalary = rand(3000, 8000);
            $allowances = rand(200, 800);
            $deductions = rand(100, 400);
            $netSalary = $baseSalary + $allowances - $deductions;
            
            $data[] = [
                'id' => $i,
                'employee_id' => 'EMP-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name' => 'Employee ' . $i,
                'department' => $departments[array_rand($departments)],
                'base_salary' => number_format($baseSalary, 2),
                'allowances' => number_format($allowances, 2),
                'deductions' => number_format($deductions, 2),
                'net_salary' => number_format($netSalary, 2),
                'payment_date' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                'status' => $statuses[array_rand($statuses)]
            ];
        }

        return $data;
    }

    public function exportPDF(Request $request)
    {
        // Generate PDF report
        // You can use DomPDF, TCPDF, or other PDF libraries
        return response()->json(['message' => 'PDF export functionality']);
    }

    public function exportCSV(Request $request)
    {
        // Generate CSV report
        return response()->json(['message' => 'CSV export functionality']);
    }
}