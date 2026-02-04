@extends('layouts.app') 

@section('title', 'Payroll') 

@section('page-title', 'Payroll Management') 

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <table id="payrollTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Employee</th>
                <th>Salary</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    console.log('jQuery ready');
    
    $('#payrollTable').DataTable({
        data: [
            [1, 'PAY-001', 'John Doe', '50000', 'Generated'],
            [2, 'PAY-002', 'Jane Smith', '45000', 'Paid']
        ]
    });
    
    console.log('DataTable initialized');
});
</script>
@endsection