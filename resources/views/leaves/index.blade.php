@extends('layouts.app') 

@section('title', 'Leaves') 
@section('page-title', 'Leaves Management') 

@section('content') 
<div class="bg-white rounded-xl shadow p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">All Leaves</h2>
            <p class="text-gray-600">Manage and track employee leave requests</p>
        </div>
        @can('apply-leave')
        <div>
            <button id="applyLeaveBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Apply Leave
            </button>
        </div>
        @endcan
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Pending Card -->
        <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-blue-700 mb-1">Pending</p>
                    <p class="text-2xl font-bold text-gray-800" id="pendingCount">0</p>
                    <div class="flex items-center mt-2">
                        <div class="w-16 bg-blue-100 rounded-full h-1.5">
                            <div class="bg-blue-500 h-1.5 rounded-full" style="width: 30%"></div>
                        </div>
                        <span class="text-xs text-blue-600 ml-2" id="pendingPercent">30%</span>
                    </div>
                </div>
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Approved Card -->
        <div class="bg-gradient-to-br from-green-50 to-white border border-green-100 rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-green-700 mb-1">Approved</p>
                    <p class="text-2xl font-bold text-gray-800" id="approvedCount">0</p>
                    <div class="flex items-center mt-2">
                        <div class="w-16 bg-green-100 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full" style="width: 50%"></div>
                        </div>
                        <span class="text-xs text-green-600 ml-2" id="approvedPercent">50%</span>
                    </div>
                </div>
                <div class="bg-green-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Rejected Card -->
        <div class="bg-gradient-to-br from-red-50 to-white border border-red-100 rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-red-700 mb-1">Rejected</p>
                    <p class="text-2xl font-bold text-gray-800" id="rejectedCount">0</p>
                    <div class="flex items-center mt-2">
                        <div class="w-16 bg-red-100 rounded-full h-1.5">
                            <div class="bg-red-500 h-1.5 rounded-full" style="width: 15%"></div>
                        </div>
                        <span class="text-xs text-red-600 ml-2" id="rejectedPercent">15%</span>
                    </div>
                </div>
                <div class="bg-red-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Total Card -->
        <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Total Leaves</p>
                    <p class="text-2xl font-bold text-gray-800" id="totalCount">0</p>
                    <div class="flex items-center mt-2">
                        <div class="w-16 bg-gray-100 rounded-full h-1.5">
                            <div class="bg-gray-500 h-1.5 rounded-full" style="width: 100%"></div>
                        </div>
                        <span class="text-xs text-gray-600 ml-2">100%</span>
                    </div>
                </div>
                <div class="bg-gray-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white border border-gray-200 rounded-xl p-4 mb-6 shadow-sm">
        <div class="flex flex-wrap items-end gap-4">
            <!-- Status Filter -->
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="filterStatus" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            
            <!-- Leave Type Filter -->
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Leave Type</label>
                <select id="filterLeaveType" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                    <option value="">All Types</option>
                    <!-- Options will be populated here -->
                </select>
            </div>
            
            <!-- Date Range Filter -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                <div class="flex space-x-2">
                    <input type="date" id="filterStartDate" class="flex-1 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                    <span class="text-gray-400 self-center">to</span>
                    <input type="date" id="filterEndDate" class="flex-1 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-2">
                <button id="filterBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">
                    Apply Filters
                </button>
                <button id="resetBtn" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="leavesTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Days</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- DataTable will populate this -->
            </tbody>
        </table>
    </div>
</div>

<!-- Apply Leave Modal -->
<div id="applyLeaveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Apply for Leave</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="applyLeaveForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Leave Type *</label>
                    <select name="leave_type_id" required class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Leave Type</option>
                        <!-- Options will be populated here -->
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                    <input type="date" name="start_date" required class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
                    <input type="date" name="end_date" required class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                    <input type="tel" name="contact_number" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Address</label>
                    <input type="text" name="contact_address" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Leave *</label>
                    <textarea name="reason" rows="3" required class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" id="cancelApply" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Submit Application</button>
            </div>
        </form>
    </div>
</div>

<!-- View Details Modal -->
<div id="viewLeaveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Leave Details</h3>
            <button id="closeViewModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div id="leaveDetails" class="space-y-4">
            <!-- Details will be loaded here -->
        </div>
        
        @can('approve-leave')
        <div id="approvalSection" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
            <h4 class="font-medium text-gray-700 mb-3">Approve/Reject Leave</h4>
            <form id="approvalForm">
                @csrf
                <input type="hidden" id="leaveId" name="leave_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Action</label>
                    <select id="approvalAction" name="action" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                        <option value="approve">Approve</option>
                        <option value="reject">Reject</option>
                        <option value="cancel">Cancel</option>
                    </select>
                </div>
                <div id="rejectionReasonField" class="mb-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Rejection</label>
                    <textarea id="rejectionReason" name="rejection_reason" rows="2" class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" id="cancelApproval" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Submit</button>
                </div>
            </form>
        </div>
        @endcan
        
        <div class="mt-6 flex justify-end">
            <button id="closeViewBtn" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">Close</button>
        </div>
    </div>
</div>
@endsection 

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<style>
    .status-badge {
        @apply px-3 py-1 rounded-full text-xs font-medium;
    }
    .status-pending { @apply bg-yellow-100 text-yellow-800; }
    .status-approved { @apply bg-green-100 text-green-800; }
    .status-rejected { @apply bg-red-100 text-red-800; }
    .status-cancelled { @apply bg-gray-100 text-gray-800; }
    
    /* DataTable custom styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply px-3 py-1 mx-1 rounded-lg border border-gray-300 hover:bg-gray-100;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply bg-blue-600 text-white border-blue-600;
    }
</style>
@endpush

@push('scripts') 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function () {

    /* ================= CSRF SETUP ================= */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }
    });


    /* ================= DATATABLE ================= */
    let table = $('#leavesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('leaves.datatable') }}",
            type: "POST",
            data: function (d) {
                d.status     = $('#filterStatus').val();
                d.leave_type = $('#filterLeaveType').val();
                d.start_date = $('#filterStartDate').val();
                d.end_date   = $('#filterEndDate').val();
            }
        },
        columns: [
            { data: 'employee', name:'employee' },
            { data: 'leave_type', name:'leave_type' },
            { data: 'dates', name:'dates' },
            { data: 'total_days', name:'total_days' },
            { data: 'reason', name:'reason' },
            { data: 'status', orderable:false, searchable:false },
            { data: 'action', orderable:false, searchable:false }
        ]
    });

    $('#filterBtn').on('click', () => table.ajax.reload());

    $('#resetBtn').on('click', () => {
        $('#filterStatus').val('');
        $('#filterLeaveType').val('');
        $('#filterStartDate').val('');
        $('#filterEndDate').val('');
        table.ajax.reload();
    });


    /* ================= LOAD LEAVE TYPES ================= */
    $.post("{{ route('leaves.types') }}", function (data) {
        $('#filterLeaveType').html('<option value="">All Types</option>');
        data.forEach(v => {
            $('#filterLeaveType')
                .append(`<option value="${v.id}">${v.name}</option>`);
        });
    });

    /* ================= APPLY MODAL ================= */
    $('#applyLeaveBtn').on('click', () =>
        $('#applyLeaveModal').removeClass('hidden')
    );

    $('#closeModal,#cancelApply').on('click', () =>
        $('#applyLeaveModal').addClass('hidden')
    );

    $('#applyLeaveForm').on('submit', function (e) {
        e.preventDefault();

        $.post("{{ route('leaves.store') }}", $(this).serialize())
            .done(() => {
                this.reset();
                $('#applyLeaveModal').addClass('hidden');
                table.ajax.reload();
            })
            .fail(err => alert('Failed to apply leave'));
    });


    /* ================= VIEW DETAILS ================= */
    $(document).on('click', '.viewLeave', function () {
        let id = $(this).data('id');

        $.get("{{ url('leaves') }}/" + id)
            .done(res => {
                $('#leaveDetails').html(`
                    <p><b>Employee:</b> ${res.employee?.name ?? '-'}</p>
                    <p><b>Type:</b> ${res.leave_type?.name ?? '-'}</p>
                    <p><b>Reason:</b> ${res.reason}</p>
                    <p><b>Status:</b> ${res.status}</p>
                `);

                $('#leaveId').val(id);
                $('#viewLeaveModal').removeClass('hidden');
            });
    });

    $('#closeViewModal,#closeViewBtn,#cancelApproval')
        .on('click', () => $('#viewLeaveModal').addClass('hidden'));


    /* ================= APPROVAL ================= */
    $('#approvalAction').on('change', function () {
        $('#rejectionReasonField')
            .toggle(this.value === 'reject');
    });

    $('#approvalForm').on('submit', function (e) {
        e.preventDefault();

        $.post("{{ route('leaves.approveReject') }}", $(this).serialize())
            .done(() => {
                $('#viewLeaveModal').addClass('hidden');
                table.ajax.reload();
            })
            .fail(() => alert('Approval failed'));
    });

});
</script>

@endpush