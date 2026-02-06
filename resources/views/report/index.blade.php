@extends('layouts.app') 

@section('title', 'Reports') 

@section('page-title', 'Report Management') 

@section('content')
<div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <p class="text-gray-600">Generate and view various HR and payroll reports</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button id="exportPdfBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    <!-- Report Type Selection -->
    <div class="mb-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="report-card bg-blue-50 border border-blue-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md report-type-btn active" data-type="payroll">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Payroll Report</h3>
                        <p class="text-sm text-gray-600">Salary & compensation</p>
                    </div>
                </div>
            </div>

            <div class="report-card bg-green-50 border border-green-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md report-type-btn" data-type="attendance">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Attendance Report</h3>
                        <p class="text-sm text-gray-600">Employee attendance</p>
                    </div>
                </div>
            </div>

            <div class="report-card bg-purple-50 border border-purple-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md report-type-btn" data-type="employee">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-4.201V5a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Employee Report</h3>
                        <p class="text-sm text-gray-600">Employee details</p>
                    </div>
                </div>
            </div>

            <div class="report-card bg-yellow-50 border border-yellow-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md report-type-btn" data-type="summary">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Summary Report</h3>
                        <p class="text-sm text-gray-600">HR overview</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-4">Report Filters</h3>

        <div class="flex flex-wrap items-end gap-4">

            <!-- Date Range -->
            <div class="relative flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                <select id="dateRange"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="this_month">This Month</option>
                    <option value="last_month">Last Month</option>
                    <option value="this_quarter">This Quarter</option>
                    <option value="last_quarter">Last Quarter</option>
                    <option value="this_year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="relative flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" id="startDate"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- End Date -->
            <div class="relative flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" id="endDate"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Department -->
            <div class="relative flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                <select id="department"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Departments</option>
                    <option value="hr">Human Resources</option>
                    <option value="it">Information Technology</option>
                    <option value="finance">Finance</option>
                    <option value="sales">Sales</option>
                    <option value="marketing">Marketing</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="relative flex-1">
                <button id="applyFilters"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Apply
                </button>
                <button id="resetFilters"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                    Reset
                </button>
            </div>

        </div>
    </div>

    <!-- Report Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-blue-600 font-medium">Total Employees</p>
                    <h3 class="text-2xl font-bold text-gray-800">148</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-4.201V5a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Active employees in system</p>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-green-600 font-medium">This Month Payroll</p>
                    <h3 class="text-2xl font-bold text-gray-800">$89,420</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Total salary disbursed</p>
        </div>

        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-purple-600 font-medium">Avg. Attendance</p>
                    <h3 class="text-2xl font-bold text-gray-800">94.2%</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">This month average</p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-yellow-600 font-medium">Pending Leaves</p>
                    <h3 class="text-2xl font-bold text-gray-800">12</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Approval required</p>
        </div>
    </div>

    <!-- Report Data Table -->
    <div class="mt-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Payroll Report</h3>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                    </svg>
                    Filter Columns
                </button>
                <button class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Export CSV
                </button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
            <table id="reportsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Base Salary</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Allowances</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deductions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Salary</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data will be populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl flex flex-col items-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
            <p class="text-gray-700">Generating report...</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<style>
    .report-card.active {
        border-color: #3b82f6;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1), 0 2px 4px -1px rgba(59, 130, 246, 0.06);
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem 2rem 0.25rem 0.5rem;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#reportsTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/report/data',
            type: 'GET',
            data: function(d) {
                d.report_type = $('.report-type-btn.active').data('type');
                d.date_range = $('#dateRange').val();
                d.start_date = $('#startDate').val();
                d.end_date = $('#endDate').val();
                d.department = $('#department').val();
            }
        },
        columns: [
            { data: 'employee_id', name: 'employee_id' },
            { data: 'name', name: 'name' },
            { data: 'department', name: 'department' },
            { 
                data: 'base_salary', 
                name: 'base_salary',
                render: function(data) {
                    return '$' + parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            },
            { 
                data: 'allowances', 
                name: 'allowances',
                render: function(data) {
                    return '$' + parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            },
            { 
                data: 'deductions', 
                name: 'deductions',
                render: function(data) {
                    return '$' + parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            },
            { 
                data: 'net_salary', 
                name: 'net_salary',
                render: function(data) {
                    return '<span class="font-semibold">$' + parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</span>';
                }
            },
            { data: 'payment_date', name: 'payment_date' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    var badgeClass = 'px-2 py-1 rounded-full text-xs font-medium ';
                    switch(data) {
                        case 'Paid':
                            badgeClass += 'bg-green-100 text-green-800';
                            break;
                        case 'Pending':
                            badgeClass += 'bg-yellow-100 text-yellow-800';
                            break;
                        case 'Processing':
                            badgeClass += 'bg-blue-100 text-blue-800';
                            break;
                        default:
                            badgeClass += 'bg-gray-100 text-gray-800';
                    }
                    return '<span class="' + badgeClass + '">' + data + '</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <div class="flex space-x-2">
                            <button class="view-details text-blue-600 hover:text-blue-800" data-id="${row.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button class="download-payslip text-green-600 hover:text-green-800" data-id="${row.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order: [[7, 'desc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                className: 'bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg'
            },
            {
                extend: 'csv',
                className: 'bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg'
            },
            {
                extend: 'excel',
                className: 'bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg'
            },
            {
                extend: 'print',
                className: 'bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg'
            }
        ]
    });

    // Report type selection
    $('.report-type-btn').click(function() {
        $('.report-type-btn').removeClass('active');
        $(this).addClass('active');
        
        var reportType = $(this).data('type');
        updateTableHeader(reportType);
        table.ajax.reload();
    });

    // Show/hide custom date range
    $('#dateRange').change(function() {
        if ($(this).val() === 'custom') {
            $('.custom-date-range').removeClass('hidden');
            $('.custom-date-range').addClass('grid');
        } else {
            $('.custom-date-range').addClass('hidden');
            $('.custom-date-range').removeClass('grid');
            table.ajax.reload();
        }
    });

    // Apply filters
    $('#applyFilters').click(function() {
        table.ajax.reload();
        showNotification('Filters applied successfully!', 'success');
    });

    // Reset filters
    $('#resetFilters').click(function() {
        $('#dateRange').val('this_month');
        $('#department').val('all');
        $('#startDate').val('');
        $('#endDate').val('');
        $('.custom-date-range').addClass('hidden');
        table.ajax.reload();
        showNotification('Filters reset successfully!', 'info');
    });

    // Export PDF
    $('#exportPdfBtn').click(function() {
        $('#loadingOverlay').removeClass('hidden');
        
        // Simulate PDF generation
        setTimeout(function() {
            $('#loadingOverlay').addClass('hidden');
            Swal.fire({
                title: 'PDF Generated!',
                text: 'Your report has been exported successfully.',
                icon: 'success',
                confirmButtonText: 'Download',
                showCancelButton: true,
                cancelButtonText: 'Close'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Trigger PDF download
                    window.location.href = '/report/export/pdf';
                }
            });
        }, 2000);
    });

    // View details button click
    $('#reportsTable').on('click', '.view-details', function() {
        var id = $(this).data('id');
        showReportDetails(id);
    });

    // Download payslip button click
    $('#reportsTable').on('click', '.download-payslip', function() {
        var id = $(this).data('id');
        downloadPayslip(id);
    });

    // Update table header based on report type
    function updateTableHeader(reportType) {
        var headers = {
            payroll: 'Payroll Report',
            attendance: 'Attendance Report',
            employee: 'Employee Report',
            summary: 'Summary Report'
        };
        
        $('h3.text-lg').text(headers[reportType] + ' Data');
    }

    // Show notification
    function showNotification(message, type) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }

    // Show report details
    function showReportDetails(id) {
        Swal.fire({
            title: 'Report Details',
            html: `
                <div class="text-left">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Employee ID</p>
                            <p class="font-semibold">EMP-${id.toString().padStart(4, '0')}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Department</p>
                            <p class="font-semibold">Information Technology</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Base Salary</p>
                            <p class="font-semibold">$4,500.00</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Net Salary</p>
                            <p class="font-semibold text-green-600">$4,850.00</p>
                        </div>
                    </div>
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-600 mb-2">Remarks</p>
                        <p class="text-sm">Salary processed for the month of ${new Date().toLocaleString('default', { month: 'long', year: 'numeric' })}</p>
                    </div>
                </div>
            `,
            showCancelButton: false,
            confirmButtonText: 'Close',
            confirmButtonColor: '#3b82f6'
        });
    }

    // Download payslip
    function downloadPayslip(id) {
        showNotification('Downloading payslip...', 'info');
        
        // Simulate download
        setTimeout(function() {
            showNotification('Payslip downloaded successfully!', 'success');
        }, 1500);
    }

    // Initialize with today's date for custom range
    var today = new Date();
    var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
    
    $('#startDate').val(lastMonth.toISOString().split('T')[0]);
    $('#endDate').val(today.toISOString().split('T')[0]);
});
</script>
@endpush