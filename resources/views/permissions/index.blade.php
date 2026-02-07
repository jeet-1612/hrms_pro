@extends('layouts.app') 

@section('title', 'Permissions') 

@section('page-title', 'Roles & Permission Management') 

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Roles & Permissions</h2>
            <p class="text-gray-600 mt-1">Manage user roles and their access permissions</p>
        </div>
        <div class="flex space-x-3 mt-4 sm:mt-0">
            <button id="addRoleBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Role
            </button>
        </div>
    </div>

    <!-- Roles List -->
    <div class="mb-8">
        <h3 class="text-lg font-medium text-gray-900 mb-4">System Roles</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Admin Role -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition duration-200">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">Administrator</h4>
                        <p class="text-sm text-gray-500">Full system access</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Admin</span>
                </div>
                <div class="mb-4">
                    <span class="text-sm text-gray-600">12 Users</span>
                </div>
                <div class="flex justify-between">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium edit-role" data-role="admin">Edit Permissions</button>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Manager Role -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition duration-200">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">Manager</h4>
                        <p class="text-sm text-gray-500">Department management access</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded">Manager</span>
                </div>
                <div class="mb-4">
                    <span class="text-sm text-gray-600">8 Users</span>
                </div>
                <div class="flex justify-between">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium edit-role" data-role="manager">Edit Permissions</button>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Employee Role -->
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition duration-200">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">Employee</h4>
                        <p class="text-sm text-gray-500">Basic user access</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Employee</span>
                </div>
                <div class="mb-4">
                    <span class="text-sm text-gray-600">45 Users</span>
                </div>
                <div class="flex justify-between">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium edit-role" data-role="employee">Edit Permissions</button>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Table -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Permission Matrix</h3>
            <div class="relative">
                <input type="text" id="searchPermissions" placeholder="Search permissions..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module/Permission</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Administrator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Dashboard -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Dashboard</div>
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">View Dashboard</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>

                    <!-- Employees -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Employees</div>
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">View Employees</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">Create Employees</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">Edit Employees</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">Delete Employees</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>

                    <!-- Departments -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Departments</div>
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">View Departments</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">Manage Departments</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>

                    <!-- Settings -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Settings</div>
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 pl-10">
                            <div class="text-sm text-gray-900">Access Settings</div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button id="savePermissions" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Save Permissions
            </button>
        </div>
    </div>
</div>

<!-- Add Role Modal -->
<div id="addRoleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Role</h3>
            
            <form id="roleForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Role Name *</label>
                    <input type="text" id="roleName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Supervisor" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea id="roleDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe the role's purpose"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="closeRoleModal" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Permissions Modal -->
<div id="editPermissionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 id="permissionModalTitle" class="text-lg font-medium text-gray-900 mb-4">Edit Permissions</h3>
            
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <!-- Permission categories will be loaded here -->
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" id="closePermissionsModal" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Cancel
                </button>
                <button type="button" id="saveRolePermissions" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Save Permissions
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Modal functions
    function openAddRoleModal() {
        $('#addRoleModal').removeClass('hidden').addClass('block');
    }

    function closeAddRoleModal() {
        $('#addRoleModal').removeClass('block').addClass('hidden');
        $('#roleForm')[0].reset();
    }

    function openEditPermissionsModal(roleName) {
        const roleTitles = {
            'admin': 'Administrator',
            'manager': 'Manager',
            'employee': 'Employee'
        };
        
        $('#permissionModalTitle').text('Edit ' + (roleTitles[roleName] || roleName) + ' Permissions');
        loadPermissionsForRole(roleName);
        $('#editPermissionsModal').removeClass('hidden').addClass('block');
    }

    function closeEditPermissionsModal() {
        $('#editPermissionsModal').removeClass('block').addClass('hidden');
    }

    // Add role button
    $('#addRoleBtn').click(openAddRoleModal);

    // Close modals
    $('#closeRoleModal').click(closeAddRoleModal);
    $('#closePermissionsModal').click(closeEditPermissionsModal);

    // Edit role permissions
    $('.edit-role').click(function() {
        const role = $(this).data('role');
        openEditPermissionsModal(role);
    });

    // Save permissions from table
    $('#savePermissions').click(function() {
        Swal.fire({
            title: 'Save Permissions?',
            text: 'Are you sure you want to update all role permissions?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save changes!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you would typically collect all checkbox values and send via AJAX
                // For this example, we'll just show success message
                Swal.fire(
                    'Saved!',
                    'All permissions have been updated successfully.',
                    'success'
                );
            }
        });
    });

    // Create new role
    $('#roleForm').submit(function(e) {
        e.preventDefault();
        
        const roleName = $('#roleName').val();
        const roleDescription = $('#roleDescription').val();
        
        // Validate
        if (!roleName.trim()) {
            Swal.fire('Error!', 'Role name is required.', 'error');
            return;
        }
        
        // Here you would typically make an AJAX call to save the role
        // For this example, we'll just show success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Role "' + roleName + '" has been created successfully!',
            showConfirmButton: false,
            timer: 2000
        });
        
        closeAddRoleModal();
        
        // In real app, you would refresh the roles list here
        // setTimeout(() => location.reload(), 500);
    });

    // Search permissions
    $('#searchPermissions').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(value) > -1);
        });
    });

    // Load permissions for a specific role (example function)
    function loadPermissionsForRole(role) {
        const permissions = {
            'dashboard': ['View Dashboard'],
            'employees': ['View Employees', 'Create Employees', 'Edit Employees', 'Delete Employees'],
            'departments': ['View Departments', 'Manage Departments'],
            'settings': ['Access Settings']
        };
        
        let html = '';
        Object.keys(permissions).forEach(category => {
            const categoryName = category.charAt(0).toUpperCase() + category.slice(1);
            html += `
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-3">${categoryName}</h4>
                    <div class="space-y-2">
            `;
            
            permissions[category].forEach(permission => {
                // In real app, you would check if this role has this permission
                const isChecked = role === 'admin' || (role === 'manager' && permission !== 'Delete Employees');
                
                html += `
                    <div class="flex items-center">
                        <input type="checkbox" id="${category}_${permission.replace(/\s+/g, '_')}" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                               ${isChecked ? 'checked' : ''}>
                        <label for="${category}_${permission.replace(/\s+/g, '_')}" class="ml-2 text-sm text-gray-700">
                            ${permission}
                        </label>
                    </div>
                `;
            });
            
            html += `
                    </div>
                </div>
            `;
        });
        
        $('#editPermissionsModal .space-y-4').html(html);
    }

    // Save role permissions
    $('#saveRolePermissions').click(function() {
        Swal.fire({
            title: 'Save Changes?',
            text: 'Are you sure you want to update this role\'s permissions?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save changes!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you would collect all checkbox values from the modal and send via AJAX
                Swal.fire(
                    'Saved!',
                    'Role permissions have been updated successfully.',
                    'success'
                );
                closeEditPermissionsModal();
            }
        });
    });

    // Close modals when clicking outside
    $(window).click(function(e) {
        if ($(e.target).is('#addRoleModal')) {
            closeAddRoleModal();
        }
        if ($(e.target).is('#editPermissionsModal')) {
            closeEditPermissionsModal();
        }
    });
});
</script>
@endpush