@extends('layouts.app') 

@section('title', 'Payroll') 

@section('page-title', 'Payroll Management') 

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" id="payrollStats">
        <!-- Stats will be loaded dynamically -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5">
            <div class="animate-pulse">
                <div class="h-4 bg-blue-200 rounded w-1/2 mb-2"></div>
                <div class="h-8 bg-blue-200 rounded w-3/4 mb-3"></div>
                <div class="h-3 bg-blue-200 rounded w-2/3"></div>
            </div>
        </div>
        <!-- Repeat for 3 more cards -->
    </div>

    <!-- Filters -->
    <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-medium text-gray-700 mb-3 md:mb-0">Filters</h3>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <select id="statusFilter" class="block w-full sm:w-48 px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="generated">Generated</option>
                        <option value="approved">Approved</option>
                        <option value="paid">Paid</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div class="relative">
                    <select id="employeeFilter" class="block w-full sm:w-64 px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Employees</option>
                    </select>
                </div>
                
                <div class="relative">
                    <input type="month" id="monthFilter" class="block w-full sm:w-48 px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="{{ date('Y-m') }}">
                </div>
                
                <button id="resetFilters" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
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
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    let payrollTable;

    // Initialize DataTable
    function initializeDataTable() {
        payrollTable = $('#payrollTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('payroll.data') }}",
                type: 'GET',
                data: function(d) {
                    d.status = $('#statusFilter').val();
                    d.month = $('#monthFilter').val();
                    d.employee_id = $('#employeeFilter').val();
                },
                error: function(xhr, error, code) {
                    console.error('DataTable Ajax Error:', xhr);
                    showNotification('Error loading payroll data. Loading sample data.', 'warning');
                    // Load dummy data as fallback
                    setTimeout(() => {
                        loadDummyData();
                    }, 1000);
                },
                dataSrc: function(json) {
                    if (!json || !json.data) {
                        console.warn('No data received from server');
                        showNotification('No payroll data available. Showing sample data.', 'info');
                        return getDummyData();
                    }
                    return json.data;
                }
            },
            columns: [
                {
                    data: 'id',
                    orderable: false,
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="${data}">`;
                    }
                },
                { 
                    data: 'payroll_code',
                    render: function(data) {
                        return `<span class="font-mono font-medium text-blue-700">${data}</span>`;
                    }
                },
                { 
                    data: 'employee',
                    render: function(data) {
                        if (!data) return '<span class="text-gray-500">N/A</span>';
                        return `
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-800 font-medium">${data.initials || 'NA'}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">${data.name || 'N/A'}</div>
                                    <div class="text-sm text-gray-500">${data.department || 'N/A'} • ${data.employee_code || 'N/A'}</div>
                                </div>
                            </div>
                        `;
                    }
                },
                { 
                    data: 'period',
                    render: function(data) {
                        if (!data) return '<span class="text-gray-500">N/A</span>';
                        const start = new Date(data.start).toLocaleDateString();
                        const end = new Date(data.end).toLocaleDateString();
                        return `
                            <div class="text-sm">
                                <div class="text-gray-900">${start} - ${end}</div>
                                <div class="text-gray-500">Pay Date: ${new Date(data.payment_date).toLocaleDateString()}</div>
                            </div>
                        `;
                    }
                },
                { 
                    data: 'basic_salary',
                    render: function(data) {
                        return `<span class="font-medium">₹ ${parseFloat(data || 0).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>`;
                    }
                },
                { 
                    data: 'total_allowances',
                    render: function(data) {
                        return `<span class="text-green-600 font-medium">+ ₹ ${parseFloat(data || 0).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>`;
                    }
                },
                { 
                    data: 'total_deductions',
                    render: function(data) {
                        return `<span class="text-red-600 font-medium">- ₹ ${parseFloat(data || 0).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>`;
                    }
                },
                { 
                    data: 'net_salary',
                    render: function(data) {
                        return `<span class="font-bold text-lg text-gray-900">₹ ${parseFloat(data || 0).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>`;
                    }
                },
                { 
                    data: 'status',
                    render: function(data) {
                        let badgeClass = '';
                        let badgeText = '';
                        
                        switch(data) {
                            case 'generated':
                                badgeClass = 'bg-yellow-100 text-yellow-800';
                                badgeText = 'Generated';
                                break;
                            case 'approved':
                                badgeClass = 'bg-blue-100 text-blue-800';
                                badgeText = 'Approved';
                                break;
                            case 'paid':
                                badgeClass = 'bg-green-100 text-green-800';
                                badgeText = 'Paid';
                                break;
                            case 'cancelled':
                                badgeClass = 'bg-red-100 text-red-800';
                                badgeText = 'Cancelled';
                                break;
                            default:
                                badgeClass = 'bg-gray-100 text-gray-800';
                                badgeText = 'Unknown';
                        }
                        
                        return `<span class="px-3 py-1 rounded-full text-xs font-medium ${badgeClass}">${badgeText}</span>`;
                    }
                },
                { 
                    data: 'payment_method',
                    render: function(data) {
                        return `<span class="text-sm text-gray-600 capitalize">${(data || 'N/A').replace('_', ' ')}</span>`;
                    }
                },
                { 
                    data: 'id',
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="flex space-x-2">
                                <button onclick="viewPayroll(${data})" class="text-blue-600 hover:text-blue-900 p-1.5 rounded hover:bg-blue-50 transition duration-200" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="editPayroll(${data})" class="text-green-600 hover:text-green-900 p-1.5 rounded hover:bg-green-50 transition duration-200" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deletePayroll(${data})" class="text-red-600 hover:text-red-900 p-1.5 rounded hover:bg-red-50 transition duration-200" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            order: [[1, 'desc']],
            pageLength: 10,
            responsive: true,
            searching: true,
            paging: true,
            info: true,
            autoWidth: false,
            language: {
                emptyTable: "No payroll records available",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                lengthMenu: "Show _MENU_ entries",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    }

    // Dummy data for testing
    function getDummyData() {
        return [
            {
                id: 1,
                payroll_code: 'PAY-2024-001',
                employee: {
                    name: 'John Doe',
                    initials: 'JD',
                    department: 'IT',
                    employee_code: 'EMP001'
                },
                period: {
                    start: '2024-01-01',
                    end: '2024-01-31',
                    payment_date: '2024-02-01'
                },
                basic_salary: 50000,
                total_allowances: 15000,
                total_deductions: 8000,
                net_salary: 57000,
                status: 'generated',
                payment_method: 'bank_transfer'
            },
            {
                id: 2,
                payroll_code: 'PAY-2024-002',
                employee: {
                    name: 'Jane Smith',
                    initials: 'JS',
                    department: 'HR',
                    employee_code: 'EMP002'
                },
                period: {
                    start: '2024-01-01',
                    end: '2024-01-31',
                    payment_date: '2024-02-01'
                },
                basic_salary: 45000,
                total_allowances: 12000,
                total_deductions: 7000,
                net_salary: 50000,
                status: 'paid',
                payment_method: 'bank_transfer'
            }
        ];
    }

    function loadDummyData() {
        if (payrollTable) {
            payrollTable.clear();
            payrollTable.rows.add(getDummyData());
            payrollTable.draw();
        }
    }

    // Global functions
    window.viewPayroll = function(id) {
        showNotification('View payroll functionality - ID: ' + id, 'info');
    };

    window.editPayroll = function(id) {
        showNotification('Edit payroll functionality - ID: ' + id, 'info');
    };

    window.deletePayroll = function(id) {
        if (confirm('Are you sure you want to delete this payroll?')) {
            showNotification('Delete payroll functionality - ID: ' + id, 'info');
        }
    };

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
            type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
            type === 'warning' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' :
            'bg-blue-100 text-blue-800 border border-blue-200'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateY(-100px)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Filter functionality
    $('#statusFilter, #monthFilter').on('change', function() {
        if (payrollTable) {
            payrollTable.ajax.reload();
        }
    });

    $('#resetFilters').on('click', function() {
        $('#statusFilter').val('');
        $('#monthFilter').val('{{ date('Y-m') }}');
        if (payrollTable) {
            payrollTable.ajax.reload();
        }
    });

    // Initialize everything
    try {
        initializeDataTable();
        showNotification('DataTable initialized successfully', 'success');
    } catch (error) {
        console.error('Initialization error:', error);
        showNotification('Error initializing DataTable: ' + error.message, 'error');
    }
});
</script>
@endsection