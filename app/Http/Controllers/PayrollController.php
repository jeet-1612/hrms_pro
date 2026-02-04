<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use PDF;

class PayrollController extends Controller
{

    public function index()
    {
        return view('payroll.index');
    }

    public function create()
    {
        $employees = Employee::orderBy('first_name')->get();
        $lastPayroll = Payroll::latest()->first();
        
        return view('payroll.create', compact('employees', 'lastPayroll'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after_or_equal:pay_period_start',
            'payment_date' => 'required|date',
            'basic_salary' => 'required|numeric|min:0',
            'house_rent_allowance' => 'nullable|numeric|min:0',
            'conveyance_allowance' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'special_allowance' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'overtime_pay' => 'nullable|numeric|min:0',
            'incentives' => 'nullable|numeric|min:0',
            'other_earnings' => 'nullable|numeric|min:0',
            'provident_fund' => 'nullable|numeric|min:0',
            'professional_tax' => 'nullable|numeric|min:0',
            'income_tax' => 'nullable|numeric|min:0',
            'loan_deduction' => 'nullable|numeric|min:0',
            'other_deductions' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:bank_transfer,cash,cheque',
            'remarks' => 'nullable|string|max:500'
        ]);

        try {
            // Calculate totals
            $totalAllowances = $request->house_rent_allowance + 
                             $request->conveyance_allowance + 
                             $request->medical_allowance + 
                             $request->special_allowance + 
                             $request->bonus + 
                             $request->overtime_pay + 
                             $request->incentives + 
                             $request->other_earnings;

            $totalDeductions = $request->provident_fund + 
                             $request->professional_tax + 
                             $request->income_tax + 
                             $request->loan_deduction + 
                             $request->other_deductions;

            $totalEarnings = $request->basic_salary + $totalAllowances;
            $netSalary = $totalEarnings - $totalDeductions;

            // Create payroll
            $payroll = Payroll::create([
                'employee_id' => $request->employee_id,
                'payroll_code' => Payroll::generatePayrollCode(),
                'pay_period_start' => $request->pay_period_start,
                'pay_period_end' => $request->pay_period_end,
                'payment_date' => $request->payment_date,
                'basic_salary' => $request->basic_salary,
                'house_rent_allowance' => $request->house_rent_allowance ?? 0,
                'conveyance_allowance' => $request->conveyance_allowance ?? 0,
                'medical_allowance' => $request->medical_allowance ?? 0,
                'special_allowance' => $request->special_allowance ?? 0,
                'bonus' => $request->bonus ?? 0,
                'overtime_pay' => $request->overtime_pay ?? 0,
                'incentives' => $request->incentives ?? 0,
                'other_earnings' => $request->other_earnings ?? 0,
                'total_earnings' => $totalEarnings,
                'provident_fund' => $request->provident_fund ?? 0,
                'professional_tax' => $request->professional_tax ?? 0,
                'income_tax' => $request->income_tax ?? 0,
                'loan_deduction' => $request->loan_deduction ?? 0,
                'other_deductions' => $request->other_deductions ?? 0,
                'total_deductions' => $totalDeductions,
                'net_salary' => $netSalary,
                'payment_method' => $request->payment_method,
                'status' => 'generated',
                'remarks' => $request->remarks,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payroll created successfully!',
                'payroll' => $payroll
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating payroll: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStats()
    {
        $stats = [
            'total_payroll' => Payroll::where('status', 'paid')->sum('net_salary'),
            'total_employees' => Payroll::distinct('employee_id')->count('employee_id'),
            'generated' => Payroll::where('status', 'generated')->count(),
            'approved' => Payroll::where('status', 'approved')->count(),
            'paid' => Payroll::where('status', 'paid')->count(),
            'cancelled' => Payroll::where('status', 'cancelled')->count(),
            'this_month' => Payroll::whereMonth('pay_period_start', date('m'))
                ->whereYear('pay_period_start', date('Y'))
                ->sum('net_salary'),
            'this_month_count' => Payroll::whereMonth('pay_period_start', date('m'))
                ->whereYear('pay_period_start', date('Y'))
                ->count(),
        ];

        return response()->json($stats);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:generated,approved,paid,cancelled',
            'remarks' => 'nullable|string|max:500'
        ]);

        try {
            $payroll = Payroll::findOrFail($id);
            
            $payroll->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payroll status updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating payroll status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:payroll,id',
            'status' => 'required|in:generated,approved,paid,cancelled',
            'remarks' => 'nullable|string|max:500'
        ]);

        try {
            Payroll::whereIn('id', $request->ids)->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bulk status update successful!',
                'count' => count($request->ids)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating payroll statuses: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:payroll,id'
        ]);

        try {
            $count = Payroll::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted ' . $count . ' payroll(s)!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting payrolls: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $payroll = Payroll::findOrFail($id);
            $payroll->delete();

            return response()->json([
                'success' => true,
                'message' => 'Payroll deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting payroll: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadPayslip($id)
    {
        try {
            $payroll = Payroll::with('employee')->findOrFail($id);
            
            // Generate PDF
            $pdf = PDF::loadView('payroll.payslip', compact('payroll'));
            
            return $pdf->download('payslip-' . $payroll->payroll_code . '.pdf');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error generating payslip: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);
        $employees = Employee::orderBy('first_name')->get();
        
        return view('payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after_or_equal:pay_period_start',
            'payment_date' => 'required|date',
            'basic_salary' => 'required|numeric|min:0',
            // ... add other validation rules
        ]);

        try {
            $payroll = Payroll::findOrFail($id);
            
            // Recalculate totals
            $totalAllowances = $request->house_rent_allowance + 
                             $request->conveyance_allowance + 
                             $request->medical_allowance + 
                             $request->special_allowance + 
                             $request->bonus + 
                             $request->overtime_pay + 
                             $request->incentives + 
                             $request->other_earnings;

            $totalDeductions = $request->provident_fund + 
                             $request->professional_tax + 
                             $request->income_tax + 
                             $request->loan_deduction + 
                             $request->other_deductions;

            $totalEarnings = $request->basic_salary + $totalAllowances;
            $netSalary = $totalEarnings - $totalDeductions;

            // Update payroll
            $payroll->update([
                'employee_id' => $request->employee_id,
                'pay_period_start' => $request->pay_period_start,
                'pay_period_end' => $request->pay_period_end,
                'payment_date' => $request->payment_date,
                'basic_salary' => $request->basic_salary,
                'house_rent_allowance' => $request->house_rent_allowance ?? 0,
                // ... update other fields
                'total_earnings' => $totalEarnings,
                'total_deductions' => $totalDeductions,
                'net_salary' => $netSalary,
                'payment_method' => $request->payment_method,
                'remarks' => $request->remarks,
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payroll updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating payroll: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPayrollData(Request $request)
    {
        // Start building the query
        $query = Payroll::with('employee')->select('payrolls.*');

        // Apply filters if any
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('month') && $request->month != '') {
            $month = $request->month;
            $query->whereMonth('pay_period_start', date('m', strtotime($month)))
                  ->whereYear('pay_period_start', date('Y', strtotime($month)));
        }

        if ($request->has('employee_id') && $request->employee_id != '') {
            $query->where('employee_id', $request->employee_id);
        }

        // Get filtered data
        $payrolls = $query->orderBy('pay_period_start', 'desc')->get();

        // Format data for DataTable
        $data = [];
        foreach ($payrolls as $payroll) {
            // Calculate allowances and deductions
            $totalAllowances = $payroll->house_rent_allowance + 
                             $payroll->conveyance_allowance + 
                             $payroll->medical_allowance + 
                             $payroll->special_allowance + 
                             $payroll->bonus + 
                             $payroll->overtime_pay + 
                             $payroll->incentives + 
                             $payroll->other_earnings;

            $totalDeductions = $payroll->provident_fund + 
                             $payroll->professional_tax + 
                             $payroll->income_tax + 
                             $payroll->loan_deduction + 
                             $payroll->other_deductions;

            // Get employee details
            $employee = $payroll->employee;
            $employeeName = $employee ? $employee->first_name . ' ' . $employee->last_name : 'N/A';
            $employeeDepartment = $employee ? ($employee->department ?? 'N/A') : 'N/A';
            $employeeDesignation = $employee ? ($employee->designation ?? 'N/A') : 'N/A';

            // Get initials for avatar
            $initials = $employee ? 
                substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1) : 
                'NA';

            $data[] = [
                'id' => $payroll->id,
                'payroll_code' => $payroll->payroll_code,
                'employee' => [
                    'id' => $payroll->employee_id,
                    'name' => $employeeName,
                    'initials' => $initials,
                    'department' => $employeeDepartment,
                    'designation' => $employeeDesignation,
                    'employee_code' => $employee ? ($employee->employee_code ?? '') : ''
                ],
                'period' => [
                    'start' => $payroll->pay_period_start,
                    'end' => $payroll->pay_period_end,
                    'payment_date' => $payroll->payment_date,
                    'month' => date('F', strtotime($payroll->pay_period_start)),
                    'year' => date('Y', strtotime($payroll->pay_period_start)),
                    'days' => date_diff(date_create($payroll->pay_period_start), date_create($payroll->pay_period_end))->format('%a') + 1
                ],
                'basic_salary' => (float) $payroll->basic_salary,
                'total_allowances' => (float) $totalAllowances,
                'total_deductions' => (float) $totalDeductions,
                'net_salary' => (float) $payroll->net_salary,
                'status' => $payroll->status,
                'payment_method' => $payroll->payment_method,
                'total_earnings' => (float) $payroll->total_earnings,
                'remarks' => $payroll->remarks,
                'approved_by' => $payroll->approved_by,
                'approved_at' => $payroll->approved_at,
                'created_at' => $payroll->created_at,
                'updated_at' => $payroll->updated_at
            ];
        }

        return response()->json([
            'draw' => $request->draw ?? 1,
            'recordsTotal' => Payroll::count(),
            'recordsFiltered' => $payrolls->count(),
            'data' => $data
        ]);
    }

    /**
     * Get payroll details for modal
     */
    public function getPayrollDetails($id)
    {
        try {
            $payroll = Payroll::with(['employee', 'approver'])->findOrFail($id);
            
            // Calculate individual allowances and deductions
            $allowances = [
                'house_rent_allowance' => (float) $payroll->house_rent_allowance,
                'conveyance_allowance' => (float) $payroll->conveyance_allowance,
                'medical_allowance' => (float) $payroll->medical_allowance,
                'special_allowance' => (float) $payroll->special_allowance,
                'bonus' => (float) $payroll->bonus,
                'overtime_pay' => (float) $payroll->overtime_pay,
                'incentives' => (float) $payroll->incentives,
                'other_earnings' => (float) $payroll->other_earnings
            ];

            $deductions = [
                'provident_fund' => (float) $payroll->provident_fund,
                'professional_tax' => (float) $payroll->professional_tax,
                'income_tax' => (float) $payroll->income_tax,
                'loan_deduction' => (float) $payroll->loan_deduction,
                'other_deductions' => (float) $payroll->other_deductions
            ];

            return response()->json([
                'success' => true,
                'payroll' => [
                    'id' => $payroll->id,
                    'payroll_code' => $payroll->payroll_code,
                    'employee' => $payroll->employee ? [
                        'id' => $payroll->employee->id,
                        'name' => $payroll->employee->first_name . ' ' . $payroll->employee->last_name,
                        'employee_code' => $payroll->employee->employee_code,
                        'department' => $payroll->employee->department,
                        'designation' => $payroll->employee->designation,
                        'email' => $payroll->employee->email,
                        'phone' => $payroll->employee->phone,
                        'bank_account' => $payroll->employee->bank_account_number,
                        'bank_name' => $payroll->employee->bank_name,
                        'ifsc_code' => $payroll->employee->ifsc_code
                    ] : null,
                    'period' => [
                        'start' => $payroll->pay_period_start,
                        'end' => $payroll->pay_period_end,
                        'payment_date' => $payroll->payment_date
                    ],
                    'earnings' => [
                        'basic_salary' => (float) $payroll->basic_salary,
                        'allowances' => $allowances,
                        'total_earnings' => (float) $payroll->total_earnings
                    ],
                    'deductions' => [
                        'items' => $deductions,
                        'total_deductions' => (float) $payroll->total_deductions
                    ],
                    'net_salary' => (float) $payroll->net_salary,
                    'payment_method' => $payroll->payment_method,
                    'status' => $payroll->status,
                    'remarks' => $payroll->remarks,
                    'approved_by' => $payroll->approver ? $payroll->approver->name : null,
                    'approved_at' => $payroll->approved_at,
                    'created_at' => $payroll->created_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payroll not found'
            ], 404);
        }
    }

    /**
     * Get employees for filter dropdown
     */
    public function getEmployees(Request $request)
    {
        $employees = Employee::select('id', 'first_name', 'last_name', 'employee_code')
            ->when($request->has('search'), function($query) use ($request) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('employee_code', 'like', "%$search%");
                });
            })
            ->orderBy('first_name')
            ->limit(50)
            ->get();

        $formatted = $employees->map(function($employee) {
            return [
                'id' => $employee->id,
                'text' => $employee->first_name . ' ' . $employee->last_name . ' (' . $employee->employee_code . ')'
            ];
        });

        return response()->json($formatted);
    }

}