@extends('layouts.app') 

@section('title', 'Designations') 

@section('page-title', 'Designation Management') 

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Designations List</h2>
            <p class="text-gray-600 mt-1">Manage all designations in the organization</p>
        </div>
        <button id="addDesignationBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-lg transition duration-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Designation
        </button>
    </div>

    <!-- Designations Table -->
    <div class="overflow-x-auto">
        <table id="designationsTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="designationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 id="modalTitle" class="text-lg font-medium text-gray-900 mb-4">Add Designation</h3>
            
            <form id="designationForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Designation Name *</label>
                    <input type="text" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Department *</label>
                    <select id="department" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Department</option>
                        <option value="IT">Information Technology</option>
                        <option value="HR">Human Resources</option>
                        <option value="FIN">Finance</option>
                        <option value="MKT">Marketing</option>
                        <option value="SAL">Sales</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Level *</label>
                    <select id="level" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Level</option>
                        <option value="junior">Junior</option>
                        <option value="mid">Mid Level</option>
                        <option value="senior">Senior</option>
                        <option value="lead">Lead</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status *</label>
                    <select id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="closeModal" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    #designationsTable_wrapper {
        margin-top: 1rem;
    }
    #designationsTable thead th {
        background-color: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }
</style>
@endpush

@push('scripts')

<script>
$(function () {
    $('#designationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('designation.datatable') }}",
        columns: [
            { data: 'id', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'department' },
            { data: 'level' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'actions', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush