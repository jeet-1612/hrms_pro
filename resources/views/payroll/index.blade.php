@extends('layouts.app') 

@section('title', 'Payroll') 

@section('page-title', 'Payroll Management') 

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Payroll</h2>
            <p class="text-gray-600">Manage employee payrolls, generate payslips, and track payments</p>
        </div>
        
        <div class="mt-4 sm:mt-0 flex flex-wrap gap-3">
            <a href="{{ route('payroll.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Generate Payroll
            </a>
            <button id="bulkProcessBtn" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-5 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Bulk Process
            </button>
            <button id="exportPayrollBtn" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 px-5 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6" id="payrollStats">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5 min-w-[250px]">
            <div class="animate-pulse">
                <div class="h-4 bg-blue-200 rounded w-1/2 mb-2"></div>
                <div class="h-8 bg-blue-200 rounded w-3/4 mb-3"></div>
                <div class="h-3 bg-blue-200 rounded w-2/3"></div>
            </div>
        </div>
        <!-- Repeat for 3 more cards -->
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl p-5 mb-6 border border-gray-200 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <!-- Left : Title -->
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Filters</h3>
            </div>

            <!-- Right : Filters -->
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                <!-- Status -->
                <div class="relative flex-1">
                    <select id="statusFilter"
                        class="w-full pl-4 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="generated">Generated</option>
                        <option value="approved">Approved</option>
                        <option value="paid">Paid</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Employee -->
                <div class="relative flex-1">
                    <select id="employeeFilter"
                        class="w-full pl-4 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Employees</option>
                    </select>
                </div>

                <!-- Month -->
                <div class="relative flex-1">
                    <input type="month" id="monthFilter"
                        class="w-full px-4 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Reset -->
                <button id="resetFilters"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 0014-7 9 9 0 00-9-9" />
                    </svg>
                    Reset
                </button>

            </div>
        </div>
    </div>

    <!-- Payroll Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table id="payrollTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payroll Code</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Basic Salary</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Allowances</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deductions</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Salary</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data will be populated by DataTable -->
            </tbody>
        </table>
    </div>

    <!-- Pagination and Info -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
        <div class="mb-4 sm:mb-0">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">Show</span>
                <select id="pageLength" class="text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="text-sm text-gray-700">entries</span>
            </div>
        </div>
        <div id="tableInfo" class="text-sm text-gray-700">
            <!-- Info will be populated by DataTable -->
        </div>
    </div>

    <!-- Bulk Actions -->
    <div id="bulkActions" class="hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 shadow-lg z-10">
        <div class="container mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-3 sm:mb-0">
                <span id="selectedCount" class="font-medium text-gray-700">0 items selected</span>
            </div>
            <div class="flex space-x-3">
                <button id="bulkApproveBtn" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-200">
                    Approve Selected
                </button>
                <button id="bulkMarkPaidBtn" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition duration-200">
                    Mark as Paid
                </button>
                <button id="bulkExportBtn" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition duration-200">
                    Export Selected
                </button>
                <button id="bulkDeleteBtn" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition duration-200">
                    Delete Selected
                </button>
                <button id="cancelBulkAction" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-200">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Payroll Details Modal -->
<div id="payrollModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Payroll Details</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto" id="modalContent">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="statusModalTitle">Update Status</h3>
            <form id="statusForm">
                <input type="hidden" id="payrollId">
                <div class="mb-4">
                    <label for="statusSelect" class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                    <select id="statusSelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="generated">Generated</option>
                        <option value="approved">Approved</option>
                        <option value="paid">Paid</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="statusRemarks" class="block text-sm font-medium text-gray-700 mb-2">Remarks</label>
                    <textarea id="statusRemarks" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Add any remarks..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelStatus" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    /* LOAD STATS */
    function loadStats() {
        $.get("{{ route('payroll.stats') }}", function (res) {
            $('#payrollStats').html(`
                <div class="bg-blue-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-600">Total Paid</p>
                    <h3 class="text-2xl font-bold">₹ ${res.total_payroll}</h3>
                </div>
                <div class="bg-green-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-600">Approved</p>
                    <h3 class="text-2xl font-bold">${res.approved}</h3>
                </div>
                <div class="bg-yellow-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-600">Generated</p>
                    <h3 class="text-2xl font-bold">${res.generated}</h3>
                </div>
                <div class="bg-purple-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-600">This Month</p>
                    <h3 class="text-2xl font-bold">₹ ${res.this_month}</h3>
                </div>
            `);
        });
    }

    loadStats();

    /* DATATABLE */
    let table = $('#payrollTable').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('payroll.data') }}",
            data: function (d) {
                d.status = $('#statusFilter').val();
                d.employee_id = $('#employeeFilter').val();
                d.month = $('#monthFilter').val();
            }
        },
        columns: [
            {
                data: 'id',
                render: id => `<input type="checkbox" class="rowCheckbox" value="${id}">`,
                orderable: false
            },
            { data: 'payroll_code' },
            {
                data: 'employee',
                render: e => `<strong>${e.name}</strong><br><small>${e.employee_code}</small>`
            },
            {
                data: 'period',
                render: p => `${p.month} ${p.year}`
            },
            { data: 'basic_salary' },
            { data: 'total_allowances' },
            { data: 'total_deductions' },
            { data: 'net_salary' },
            {
                data: 'status',
                render: s => `<span class="px-2 py-1 rounded text-xs bg-gray-200">${s}</span>`
            },
            { data: 'payment_method' },
            {
                data: 'id',
                render: id => `
                    <button class="viewPayroll text-blue-600" data-id="${id}"><i class="fas fa-eye"></i></button>
                    <button class="deletePayroll text-red-600 ml-2" data-id="${id}"><i class="fas fa-trash"></i></button>
                `
            }
        ]
    });

    /* FILTERS */
    $('#statusFilter, #employeeFilter, #monthFilter').on('change', function () {
        table.ajax.reload();
    });

    $('#resetFilters').on('click', function () {
        $('#statusFilter, #employeeFilter').val('');
        $('#monthFilter').val("{{ date('Y-m') }}");
        table.ajax.reload();
    });

    /* EMPLOYEE DROPDOWN */
    $.get("{{ route('payroll.employees') }}", function (res) {
        res.forEach(emp => {
            $('#employeeFilter').append(`<option value="${emp.id}">${emp.text}</option>`);
        });
    });

    /* VIEW MODAL */
    $(document).on('click', '.viewPayroll', function () {
        let id = $(this).data('id');
        $('#payrollModal').removeClass('hidden');

        $.get(`/payroll/${id}/details`, function (res) {
            $('#modalContent').html(`
                <h4 class="text-lg font-semibold mb-2">${res.payroll.employee.name}</h4>
                <p>Net Salary: ₹ ${res.payroll.net_salary}</p>
                <p>Status: ${res.payroll.status}</p>
            `);
        });
    });

    $('#closeModal').on('click', function () {
        $('#payrollModal').addClass('hidden');
    });

    /* DELETE */
    $(document).on('click', '.deletePayroll', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: "Delete payroll?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes delete"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/payroll/${id}`,
                    type: 'DELETE',
                    data: {_token: "{{ csrf_token() }}"},
                    success: function () {
                        table.ajax.reload();
                        loadStats();
                    }
                });
            }
        });
    });

});
</script>

@endpush