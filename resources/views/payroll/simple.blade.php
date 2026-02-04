@extends('layouts.app') 

@section('title', 'Payroll') 

@section('page-title', 'Payroll Management') 

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <table id="payrollTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Employee</th>
                <th>Period</th>
                <th>Basic</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#payrollTable').DataTable({
        data: [
            [1, 'PAY-001', 'John Doe', '2024-01-01 to 2024-01-31', '₹50,000', '₹15,000', '₹8,000', '₹57,000', 'Generated', 'Bank Transfer', 'View']
        ]
    });
});
</script>
@endpush