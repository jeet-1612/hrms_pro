@extends('layouts.app') 

@section('title', 'Settings') 

@section('page-title', 'Settings Management') 

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">System Settings</h2>
            <p class="text-gray-600 mt-1">Manage your application settings and preferences</p>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="mb-8">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button class="settings-tab active border-b-2 border-blue-500 text-blue-600 px-1 py-4 text-sm font-medium" data-tab="general">
                    General Settings
                </button>
                <button class="settings-tab border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium" data-tab="email">
                    Email Settings
                </button>
                <button class="settings-tab border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium" data-tab="security">
                    Security
                </button>
                <button class="settings-tab border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium" data-tab="appearance">
                    Appearance
                </button>
            </nav>
        </div>
    </div>

    <!-- Settings Content -->
    <div id="settingsContent">
        
        <!-- General Settings Tab -->
        <div id="generalTab" class="settings-tab-content active">
            <form id="generalSettingsForm">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Application Settings</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Application Name</label>
                                <input type="text" name="app_name" value="HR Management System" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                                <select name="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="UTC">UTC</option>
                                    <option value="Asia/Kolkata" selected>India Standard Time (IST)</option>
                                    <option value="America/New_York">Eastern Time (ET)</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
                                <select name="date_format" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Y-m-d">YYYY-MM-DD</option>
                                    <option value="d/m/Y" selected>DD/MM/YYYY</option>
                                    <option value="m/d/Y">MM/DD/YYYY</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Items Per Page</label>
                                <input type="number" name="items_per_page" value="10" min="5" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                <input type="text" name="company_name" value="Tech Solutions Inc." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                                <textarea name="company_address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">123 Business Street, Mumbai, India</textarea>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Phone</label>
                                    <input type="text" name="company_phone" value="+91 9876543210" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Email</label>
                                    <input type="email" name="company_email" value="info@techsolutions.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save General Settings
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Email Settings Tab -->
        <div id="emailTab" class="settings-tab-content hidden">
            <form id="emailSettingsForm">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">SMTP Configuration</h3>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                                    <input type="text" name="smtp_host" value="smtp.gmail.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                                    <input type="number" name="smtp_port" value="587" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Username</label>
                                    <input type="text" name="smtp_username" value="noreply@yourdomain.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Password</label>
                                    <input type="password" name="smtp_password" placeholder="Enter SMTP password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Encryption</label>
                                    <select name="encryption" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="tls" selected>TLS</option>
                                        <option value="ssl">SSL</option>
                                        <option value="">None</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">From Address</label>
                                    <input type="email" name="from_address" value="noreply@yourdomain.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Email Templates</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Welcome Email Subject</label>
                                <input type="text" name="welcome_subject" value="Welcome to Our Company!" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Welcome Email Template</label>
                                <textarea name="welcome_template" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Dear {employee_name}, Welcome to our team! We're excited to have you on board.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Email Settings
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Security Settings Tab -->
        <div id="securityTab" class="settings-tab-content hidden">
            <form id="securitySettingsForm">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Password Policy</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="password_complexity" name="password_complexity" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="password_complexity" class="ml-2 block text-sm text-gray-700">Require strong passwords (min. 8 characters, mix of letters, numbers, symbols)</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="password_expiry" name="password_expiry" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="password_expiry" class="ml-2 block text-sm text-gray-700">Enable password expiry (90 days)</label>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Password Length</label>
                                    <input type="number" name="min_password_length" value="8" min="6" max="20" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Failed Login Attempts</label>
                                    <input type="number" name="failed_attempts" value="5" min="3" max="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Session Settings</h3>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
                                    <input type="number" name="session_timeout" value="30" min="5" max="480" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Devices</label>
                                    <input type="number" name="max_devices" value="3" min="1" max="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Two-Factor Authentication</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="enable_2fa" name="enable_2fa" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="enable_2fa" class="ml-2 block text-sm text-gray-700">Enable Two-Factor Authentication for all users</label>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">2FA Method</label>
                                <select name="2fa_method" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="email">Email</option>
                                    <option value="sms">SMS</option>
                                    <option value="app">Authenticator App</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Security Settings
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Appearance Settings Tab -->
        <div id="appearanceTab" class="settings-tab-content hidden">
            <form id="appearanceSettingsForm">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Theme Settings</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Theme Color</label>
                                <div class="flex space-x-4">
                                    <div class="theme-color" data-color="blue">
                                        <div class="w-10 h-10 bg-blue-600 rounded-full cursor-pointer border-2 border-blue-600"></div>
                                        <span class="text-xs mt-1">Blue</span>
                                    </div>
                                    <div class="theme-color" data-color="green">
                                        <div class="w-10 h-10 bg-green-600 rounded-full cursor-pointer border-2 border-gray-300"></div>
                                        <span class="text-xs mt-1">Green</span>
                                    </div>
                                    <div class="theme-color" data-color="purple">
                                        <div class="w-10 h-10 bg-purple-600 rounded-full cursor-pointer border-2 border-gray-300"></div>
                                        <span class="text-xs mt-1">Purple</span>
                                    </div>
                                    <div class="theme-color" data-color="red">
                                        <div class="w-10 h-10 bg-red-600 rounded-full cursor-pointer border-2 border-gray-300"></div>
                                        <span class="text-xs mt-1">Red</span>
                                    </div>
                                </div>
                                <input type="hidden" id="theme_color" name="theme_color" value="blue">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Theme Mode</label>
                                <div class="flex space-x-4">
                                    <div class="theme-mode" data-mode="light">
                                        <div class="w-24 h-16 bg-white border-2 border-blue-500 rounded-lg cursor-pointer flex items-center justify-center">
                                            <span class="text-sm">Light</span>
                                        </div>
                                    </div>
                                    <div class="theme-mode" data-mode="dark">
                                        <div class="w-24 h-16 bg-gray-800 border-2 border-gray-300 rounded-lg cursor-pointer flex items-center justify-center">
                                            <span class="text-sm text-white">Dark</span>
                                        </div>
                                    </div>
                                    <div class="theme-mode" data-mode="auto">
                                        <div class="w-24 h-16 bg-gradient-to-r from-white to-gray-800 border-2 border-gray-300 rounded-lg cursor-pointer flex items-center justify-center">
                                            <span class="text-sm">Auto</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="theme_mode" name="theme_mode" value="light">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Dashboard Settings</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="show_welcome" name="show_welcome" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_welcome" class="ml-2 block text-sm text-gray-700">Show welcome message on dashboard</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="show_stats" name="show_stats" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_stats" class="ml-2 block text-sm text-gray-700">Show statistics cards</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="show_recent" name="show_recent" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_recent" class="ml-2 block text-sm text-gray-700">Show recent activities</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Appearance Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('styles')
<style>
    .theme-color {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .theme-mode > div {
        transition: all 0.2s;
    }
    
    .theme-mode.active > div {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .settings-tab.active {
        color: #2563eb;
        border-color: #2563eb;
    }
    
    .settings-tab-content.active {
        display: block;
    }
    
    .settings-tab-content {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Tab switching
    $('.settings-tab').click(function() {
        // Remove active class from all tabs
        $('.settings-tab').removeClass('active').addClass('text-gray-500 hover:text-gray-700 hover:border-gray-300');
        $('.settings-tab').removeClass('border-blue-500 text-blue-600');
        $('.settings-tab-content').removeClass('active').addClass('hidden');
        
        // Add active class to clicked tab
        $(this).addClass('active border-b-2 border-blue-500 text-blue-600');
        $(this).removeClass('text-gray-500 hover:text-gray-700 hover:border-gray-300');
        
        // Show corresponding content
        const tabId = $(this).data('tab');
        $('#' + tabId + 'Tab').addClass('active').removeClass('hidden');
    });
    
    // Theme color selection
    $('.theme-color').click(function() {
        $('.theme-color div').removeClass('border-blue-600').addClass('border-gray-300');
        $(this).find('div').removeClass('border-gray-300').addClass('border-blue-600');
        $('#theme_color').val($(this).data('color'));
    });
    
    // Theme mode selection
    $('.theme-mode').click(function() {
        $('.theme-mode').removeClass('active');
        $(this).addClass('active');
        $('#theme_mode').val($(this).data('mode'));
    });
    
    // Form submissions
    $('form[id$="Form"]').submit(function(e) {
        e.preventDefault();
        const formId = $(this).attr('id');
        const formName = formId.replace('SettingsForm', '').replace(/([A-Z])/g, ' $1').trim();
        
        // Show success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: formName + ' settings saved successfully!',
            showConfirmButton: false,
            timer: 2000
        });
        
        // In a real application, you would make an AJAX call here:
        // $.ajax({
        //     url: '/api/settings/' + formId.replace('Form', ''),
        //     method: 'POST',
        //     data: $(this).serialize(),
        //     success: function(response) {
        //         Swal.fire('Success!', 'Settings saved successfully!', 'success');
        //     },
        //     error: function() {
        //         Swal.fire('Error!', 'Failed to save settings', 'error');
        //     }
        // });
    });
    
    // Test email configuration button (optional)
    $('#testEmailBtn').click(function() {
        Swal.fire({
            title: 'Test Email',
            text: 'Send a test email to verify SMTP configuration?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Send Test Email',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve();
                    }, 2000);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Sent!', 'Test email has been sent successfully.', 'success');
            }
        });
    });
});
</script>
@endpush