<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'payroll_code',
        'pay_period_start',
        'pay_period_end',
        'payment_date',
        'basic_salary',
        'house_rent_allowance',
        'conveyance_allowance',
        'medical_allowance',
        'special_allowance',
        'bonus',
        'overtime_pay',
        'incentives',
        'other_earnings',
        'total_earnings',
        'provident_fund',
        'professional_tax',
        'income_tax',
        'loan_deduction',
        'other_deductions',
        'total_deductions',
        'net_salary',
        'payment_method',
        'status',
        'remarks',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'pay_period_start' => 'date',
        'pay_period_end' => 'date',
        'payment_date' => 'date',
        'basic_salary' => 'decimal:2',
        'house_rent_allowance' => 'decimal:2',
        'conveyance_allowance' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'special_allowance' => 'decimal:2',
        'bonus' => 'decimal:2',
        'overtime_pay' => 'decimal:2',
        'incentives' => 'decimal:2',
        'other_earnings' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'provident_fund' => 'decimal:2',
        'professional_tax' => 'decimal:2',
        'income_tax' => 'decimal:2',
        'loan_deduction' => 'decimal:2',
        'other_deductions' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    /**
     * Get the employee associated with the payroll
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the approver (user) who approved the payroll
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Generate payroll code
     */
    public static function generatePayrollCode()
    {
        $prefix = 'PAY';
        $year = date('Y');
        $month = date('m');
        
        $lastPayroll = self::where('payroll_code', 'like', $prefix . '-' . $year . $month . '%')
            ->orderBy('payroll_code', 'desc')
            ->first();
        
        if ($lastPayroll) {
            $lastNumber = (int) substr($lastPayroll->payroll_code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return $prefix . '-' . $year . $month . '-' . $newNumber;
    }
}