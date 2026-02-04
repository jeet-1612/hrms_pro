@extends('layouts.app')

@section('title', 'Employees')
@section('page-title', 'Employee Management')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">All Employees</h2>
        <button
            id="openEmpModal"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Add New Employee
        </button>
    </div>
    
    <!-- Search and Filter -->
    <button id="toggleFilter"
        class="mb-4 bg-gray-100 px-4 py-2 rounded-lg border hover:bg-gray-200">
        🔍 Filters
    </button>
    <div id="filterBox" class="mb-6 hidden">
        <div class="border rounded-lg p-4 bg-gray-50">
            <div class="flex gap-4">
                <input type="text" id="searchInput"
                    placeholder="Search employees..."
                    class="border rounded-lg px-4 py-2 flex-1">

                <select id="departmentFilter" class="border rounded-lg px-4 py-2">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>

                <button id="applyFilter"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                    Apply
                </button>

                <button id="resetFilter"
                    class="bg-gray-300 px-6 py-2 rounded-lg hover:bg-gray-400">
                    Reset
                </button>
            </div>
        </div>
    </div>

    
    <!-- Employees Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="employeeTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Employee ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Department
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Designation
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                
            </tbody>
        </table>
    </div>

    <!-- Employee Modal -->
    <div id="empModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-2">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">
            <!-- Header -->
            <div class="flex justify-between items-center px-4 py-3 border-b bg-gradient-to-r from-blue-50 to-white">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Add Employee</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-700 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <form id="employeeForm" class="px-4 py-4 space-y-3">
                @csrf
                <input type="hidden" id="employee_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Employee Code -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Employee Code <span class="text-red-500">*</span></label>
                        <input type="text" id="employee_code" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Gender <span class="text-red-500">*</span></label>
                        <select id="gender" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- First Name -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="first_name" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="last_name" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                    </div>

                    <!-- DOB -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" id="date_of_birth" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                    </div>

                    <!-- Joining Date -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Joining Date <span class="text-red-500">*</span></label>
                        <input type="date" id="joining_date" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Department <span class="text-red-500">*</span></label>
                        <select id="department_id" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                            <option value="">Select</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Designation -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Designation <span class="text-red-500">*</span></label>
                        <select id="designation_id" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                            <option value="">Select</option>
                            @foreach($designations as $desig)
                                <option value="{{ $desig->id }}">{{ $desig->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Employment Type -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Employment Type</label>
                        <select id="employment_type" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                            <option value="">Select</option>
                            <option value="probation">Probation</option>
                            <option value="permanent">Permanent</option>
                            <option value="contract">Contract</option>
                            <option value="intern">Intern</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                        <select id="employment_status" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Current Address <span class="text-red-500">*</span></label>
                        <textarea id="current_address" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" rows="2"></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-2 px-4 py-3 border-t">
                    <button type="button" id="cancelModal" class="px-4 py-1.5 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Employee Modal -->
    <div id="viewEmpModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-2">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">
            <!-- Header -->
            <div class="flex justify-between items-center px-4 py-3 bg-gradient-to-r from-blue-50 to-white border-b border-gray-200">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Employee Details</h3>
                    <p class="text-sm text-gray-500 mt-1">Complete information about this employee</p>
                </div>
                <button id="closeViewModal" class="text-gray-400 hover:text-gray-700 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="px-4 py-4 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Left Column -->
                    <div class="space-y-2">
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Employee Code</div>
                            <div id="view_employee_code" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Full Name</div>
                            <div id="view_full_name" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Gender</div>
                            <div id="view_gender" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Department</div>
                            <div id="view_department" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Designation</div>
                            <div id="view_designation" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-2">
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Employment Type</div>
                            <div id="view_employment_type" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Status</div>
                            <div id="view_status" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Date of Birth</div>
                            <div id="view_date_of_birth" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                        <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-500 uppercase mb-1">Joining Date</div>
                            <div id="view_joining_date" class="text-sm font-semibold text-gray-800">--</div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="p-2 rounded-lg bg-gray-50 border border-gray-100">
                    <div class="text-xs font-medium text-gray-500 uppercase mb-1">Current Address</div>
                    <div id="view_current_address" class="text-sm font-semibold text-gray-800">--</div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end px-4 py-3 border-t border-gray-200 bg-gray-50">
                <button type="button" id="closeViewModalBtn" class="px-4 py-2 bg-gray-800 text-white font-medium rounded hover:bg-gray-900 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

</div>
@endsection


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
let employeeTable;

$(document).ready(function () {

    employeeTable = $('#employeeTable').DataTable({
        processing: true,
        serverSide: true,

        ajax: {
            url: "{{ route('employees.datatable') }}",
            type: "POST",
            data: function (d) {
                d._token = "{{ csrf_token() }}";
                d.search_text = $('#searchInput').val();
                d.department  = $('#departmentFilter').val();
            }
        },

        columns: [
            { data: 'employee_code' },
            { data: 'name', orderable: false, searchable: false },
            { data: 'department' },
            { data: 'designation' },
            { data: 'status', orderable: false },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    // Apply filter
    $('#applyFilter').on('click', function () {
        employeeTable.ajax.reload();
    });

    // Reset filter
    $('#resetFilter').on('click', function () {
        $('#searchInput').val('');
        $('#departmentFilter').val('');
        employeeTable.ajax.reload();
    });

    $('#toggleFilter').on('click', function () {
        $('#filterBox').slideToggle();
    });


    let modal = $('#empModal');

    // OPEN ADD MODAL
    $('#openEmpModal').on('click', function () {
        $('#employeeForm')[0].reset();
        $('#employee_id').val('');
        $('#modalTitle').text('Add Employee');

        modal.removeClass('hidden').addClass('flex');
    });

    // CLOSE MODAL (X & Cancel)
    $('#closeModal, #cancelModal').on('click', function () {
        modal.removeClass('flex').addClass('hidden');
    });

    // OPTIONAL: backdrop click to close
    modal.on('click', function (e) {
        if ($(e.target).is('#empModal')) {
            modal.removeClass('flex').addClass('hidden');
        }
    });

    // SUBMIT (ADD / UPDATE)
    $('#employeeForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("employees.save") }}',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                employee_id: $('#employee_id').val(), // <-- same name as backend
                employee_code: $('#employee_code').val(),
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                department_id: $('#department_id').val(),
                designation_id: $('#designation_id').val(),
                gender: $('#gender').val(),
                employment_type: $('#employment_type').val(),
                employment_status: $('#employment_status').val(),
                date_of_birth: $('#date_of_birth').val(),
                joining_date: $('#joining_date').val(),
                current_address: $('#current_address').val()
            },
            success: function(res) {
                alert(res.message);
                $('#empModal').addClass('hidden');
                $('#employeeTable').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('Validation error');
            }
        });
    });


    // OPEN EDIT MODAL
    $('#employeeTable').on('click', '.editBtn', function () {
        let rowData = employeeTable.row($(this).parents('tr')).data();

        $('#employee_id').val(rowData.id);
        $('#employee_code').val(rowData.employee_code);
        $('#gender').val(rowData.gender);
        $('#first_name').val(rowData.first_name);
        $('#last_name').val(rowData.last_name);
        $('#department_id').val(rowData.department_id);
        $('#designation_id').val(rowData.designation_id);
        $('#current_address').val(rowData.current_address);
        $('#date_of_birth').val(rowData.date_of_birth);
        $('#joining_date').val(rowData.joining_date);
        $('#employment_type').val(rowData.employment_type);
        $('#employment_status').val(rowData.employment_status);
        $('#modalTitle').text('Edit Employee');
        $('#empModal').removeClass('hidden').addClass('flex');
    });


    // Open View Modal
    $('#employeeTable').on('click', '.viewBtn', function () {
        let rowData = employeeTable.row($(this).parents('tr')).data();

        // Populate data
        $('#view_employee_code').text(rowData.employee_code);
        $('#view_full_name').text(rowData.first_name + ' ' + rowData.last_name);
        $('#view_gender').text(rowData.gender || '-');
        $('#view_department').text(rowData.department || '-');
        $('#view_designation').text(rowData.designation || '-');
        $('#view_employment_type').text(rowData.employment_type || '-');
        $('#view_status').text(rowData.employment_status ? rowData.employment_status.toUpperCase() : '-');
        $('#view_date_of_birth').text(rowData.date_of_birth || '-');
        $('#view_joining_date').text(rowData.joining_date || '-');
        $('#view_current_address').text(rowData.current_address || '-');

        // Show modal
        $('#viewEmpModal').removeClass('hidden').addClass('flex');
    });

    // Close Modal
    $('#closeViewModal, #closeViewModalBtn').on('click', function () {
        $('#viewEmpModal').addClass('hidden').removeClass('flex');
    });

    // DELETE Employee
    $(document).on('click', '.deleteBtn', function () {
        let rowData = employeeTable.row($(this).parents('tr')).data();
        let id = rowData.id;

        if (!confirm('Delete employee?')) return;

        $.ajax({
            url: '/employees/' + id,
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                alert(res.message);
                $('#employeeTable').DataTable().ajax.reload();
            },
            error: function (xhr) {
                alert('Delete failed');
            }
        });
    });

});
</script>