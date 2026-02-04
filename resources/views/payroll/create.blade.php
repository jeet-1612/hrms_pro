@extends('layouts.app')

@section('title', 'Create Payroll')
@section('page-title', 'Create Payroll')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Generate New Payroll</h2>
        <p class="text-gray-600 mt-1">Create payroll for an employee</p>
    </div>

    <form id="payrollForm" method="POST" action="{{ route('payroll.store') }}">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Employee Selection -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">Employee *</label>
                <select id="employee_id" name="employee_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->employee_code }}) - {{ $employee->department }}
                        </option>
                    @endforeach
                </select>
                <div id="employeeDetails" class="mt-3 p-4 bg-gray-50 rounded-lg hidden">
                    <!-- Employee details will be loaded here -->
                </div>
            </div>

            <!-- Payroll Period -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="pay_period_start" class="block text-sm font-medium text-gray-700 mb-2">Period Start *</label>
                    <input type="date" id="pay_period_start" name="pay_period_start" required 
                           value="{{ date('Y-m-01') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="pay_period_end" class="block text-sm font-medium text-gray-700 mb-2">Period End *</label>
                    <input type="date" id="pay_period_end" name="pay_period_end" required 
                           value="{{ date('Y-m-t') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Payment Date -->
            <div>
                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Payment Date *</label>
                <input type="date" id="payment_date" name="payment_date" required 
                       value="{{ date('Y-m-d', strtotime('+5 days')) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Payment Method -->
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                <select id="payment_method" name="payment_method" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>
                </select>
            </div>
        </div>

        <!-- Earnings Section -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Earnings</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="basic_salary" class="block text-sm font-medium text-gray-700 mb-2">Basic Salary *</label>
                    <input type="number" step="0.01" id="basic_salary" name="basic_salary" required 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="house_rent_allowance" class="block text-sm font-medium text-gray-700 mb-2">House Rent Allowance</label>
                    <input type="number" step="0.01" id="house_rent_allowance" name="house_rent_allowance" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="conveyance_allowance" class="block text-sm font-medium text-gray-700 mb-2">Conveyance Allowance</label>
                    <input type="number" step="0.01" id="conveyance_allowance" name="conveyance_allowance" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="medical_allowance" class="block text-sm font-medium text-gray-700 mb-2">Medical Allowance</label>
                    <input type="number" step="0.01" id="medical_allowance" name="medical_allowance" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="special_allowance" class="block text-sm font-medium text-gray-700 mb-2">Special Allowance</label>
                    <input type="number" step="0.01" id="special_allowance" name="special_allowance" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="bonus" class="block text-sm font-medium text-gray-700 mb-2">Bonus</label>
                    <input type="number" step="0.01" id="bonus" name="bonus" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="overtime_pay" class="block text-sm font-medium text-gray-700 mb-2">Overtime Pay</label>
                    <input type="number" step="0.01" id="overtime_pay" name="overtime_pay" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="incentives" class="block text-sm font-medium text-gray-700 mb-2">Incentives</label>
                    <input type="number" step="0.01" id="incentives" name="incentives" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="other_earnings" class="block text-sm font-medium text-gray-700 mb-2">Other Earnings</label>
                    <input type="number" step="0.01" id="other_earnings" name="other_earnings" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Deductions Section -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">Deductions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="provident_fund" class="block text-sm font-medium text-gray-700 mb-2">Provident Fund</label>
                    <input type="number" step="0.01" id="provident_fund" name="provident_fund" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="professional_tax" class="block text-sm font-medium text-gray-700 mb-2">Professional Tax</label>
                    <input type="number" step="0.01" id="professional_tax" name="professional_tax" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="income_tax" class="block text-sm font-medium text-gray-700 mb-2">Income Tax (TDS)</label>
                    <input type="number" step="0.01" id="income_tax" name="income_tax" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="loan_deduction" class="block text-sm font-medium text-gray-700 mb-2">Loan Deduction</label>
                    <input type="number" step="0.01" id="loan_deduction" name="loan_deduction" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="other_deductions" class="block text-sm font-medium text-gray-700 mb-2">Other Deductions</label>
                    <input type="number" step="0.01" id="other_deductions" name="other_deductions" 
                           placeholder="0.00" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="mb-8 p-6 bg-blue-50 rounded-lg border border-blue-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Salary Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Earnings</h4>
                    <div class="space-y-1">
                        <div class="flex justify-between">
                            <span>Basic Salary:</span>
                            <span id="basicSalaryDisplay" class="font-medium">₹ 0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Allowances:</span>
                            <span id="totalAllowances" class="font-medium text-green-600">₹ 0.00</span>
                        </div>
                        <div class="flex justify-between border-t border-blue-200 pt-2 mt-2">
                            <span class="font-semibold">Total Earnings:</span>
                            <span id="totalEarnings" class="font-bold text-green-700">₹ 0.00</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Deductions</h4>
                    <div class="space-y-1">
                        <div class="flex justify-between">
                            <span>Total Deductions:</span>
                            <span id="totalDeductions" class="font-medium text-red-600">₹ 0.00</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg border border-blue-300">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Net Salary:</span>
                        <span id="netSalary" class="text-2xl font-bold text-blue-700">₹ 0.00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remarks -->
        <div class="mb-8">
            <label for="remarks" class="block text-sm font-medium text-gray-700 mb-2">Remarks (Optional)</label>
            <textarea id="remarks" name="remarks" rows="3" 
                      placeholder="Add any remarks or notes..."
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('payroll.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                Generate Payroll
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calculate totals whenever any amount field changes
        const amountFields = document.querySelectorAll('input[type="number"]');
        amountFields.forEach(field => {
            field.addEventListener('input', calculateTotals);
        });

        function calculateTotals() {
            // Get all earning values
            const basicSalary = parseFloat(document.getElementById('basic_salary').value) || 0;
            const houseRent = parseFloat(document.getElementById('house_rent_allowance').value) || 0;
            const conveyance = parseFloat(document.getElementById('conveyance_allowance').value) || 0;
            const medical = parseFloat(document.getElementById('medical_allowance').value) || 0;
            const special = parseFloat(document.getElementById('special_allowance').value) || 0;
            const bonus = parseFloat(document.getElementById('bonus').value) || 0;
            const overtime = parseFloat(document.getElementById('overtime_pay').value) || 0;
            const incentives = parseFloat(document.getElementById('incentives').value) || 0;
            const otherEarnings = parseFloat(document.getElementById('other_earnings').value) || 0;

            // Get all deduction values
            const providentFund = parseFloat(document.getElementById('provident_fund').value) || 0;
            const professionalTax = parseFloat(document.getElementById('professional_tax').value) || 0;
            const incomeTax = parseFloat(document.getElementById('income_tax').value) || 0;
            const loanDeduction = parseFloat(document.getElementById('loan_deduction').value) || 0;
            const otherDeductions = parseFloat(document.getElementById('other_deductions').value) || 0;

            // Calculate totals
            const totalAllowances = houseRent + conveyance + medical + special + bonus + overtime + incentives + otherEarnings;
            const totalEarnings = basicSalary + totalAllowances;
            const totalDeductions = providentFund + professionalTax + incomeTax + loanDeduction + otherDeductions;
            const netSalary = totalEarnings - totalDeductions;

            // Update display
            document.getElementById('basicSalaryDisplay').textContent = '₹ ' + formatCurrency(basicSalary);
            document.getElementById('totalAllowances').textContent = '₹ ' + formatCurrency(totalAllowances);
            document.getElementById('totalEarnings').textContent = '₹ ' + formatCurrency(totalEarnings);
            document.getElementById('totalDeductions').textContent = '₹ ' + formatCurrency(totalDeductions);
            document.getElementById('netSalary').textContent = '₹ ' + formatCurrency(netSalary);
        }

        function formatCurrency(amount) {
            return amount.toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Form submission
        document.getElementById('payrollForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Payroll created successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = "{{ route('payroll.index') }}";
                    }, 1500);
                } else {
                    showNotification(data.message || 'Error creating payroll', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error creating payroll', 'error');
            });
        });

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-transform duration-300 translate-y-0 ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
                type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
                'bg-blue-100 text-blue-800 border border-blue-200'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        ${
                            type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                            type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateY(-100px)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Calculate totals on page load
        calculateTotals();
    });
</script>
@endsection