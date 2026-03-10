@extends('layouts.app')

@section('title', 'Attendance')
@section('page-title', 'Attendance Management')

@section('content')
<div class="bg-white rounded-xl shadow p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Attendance Records</h2>
            <p class="text-sm text-gray-500">Daily employee attendance</p>
        </div>
        <a href="{{ route('attendance.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
            <i class="fas fa-plus mr-2"></i> Mark Attendance
        </a>
    </div>

    <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">
        <input type="date" id="filter_date"
               class="border rounded px-3 py-2 text-sm">

        <select id="filter_status"
                class="border rounded px-3 py-2 text-sm">
            <option value="">All Status</option>
            <option value="present">Present</option>
            <option value="absent">Absent</option>
            <option value="late">Late</option>
            <option value="half_day">Half Day</option>
            <option value="on_leave">On Leave</option>
            <option value="holiday">Holiday</option>
            <option value="weekend">Weekend</option>
        </select>

        <button id="filterBtn"
                class="bg-gray-800 text-white rounded px-4 py-2 text-sm">
            Apply Filter
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="attendanceTable" class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Employee</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Total Hours</th>
                    <th class="px-4 py-3">Approved</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')

<script>
$(function () {

    let table = $('#attendanceTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('attendance.datatable') }}",
            type: "POST",
            data: function (d) {
                d._token = "{{ csrf_token() }}";
                d.date   = $('#filter_date').val();
                d.status = $('#filter_status').val();
            }
        },
        columns: [
            { data: 'employee' },
            { data: 'date' },
            { data: 'check_in' },
            { data: 'check_out' },
            { data: 'status' },
            { data: 'total_hours' },
            { data: 'approved' },
        ]
    });

    $('#filterBtn').click(function () {
        table.ajax.reload();
    });

});
</script>
@endpush
