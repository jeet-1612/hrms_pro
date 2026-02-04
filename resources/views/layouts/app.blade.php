<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | HRMS Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    
    @stack('styles')
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #4338CA;
            --secondary: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            overflow-x: hidden;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Main Wrapper -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        @if(auth()->check())
            @include('partials.sidebar')
        @endif
        
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @if(auth()->check())
                @include('partials.header')
            @endif
            
            <!-- Main Content with Footer -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-100">
                <div class="min-h-full flex flex-col">
                    <div class="flex-1">
                        <div class="container mx-auto px-6 py-8">
                            <!-- Page Title -->
                            @hasSection('page-title')
                                <div class="mb-6">
                                    <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title')</h1>
                                    @hasSection('page-description')
                                        <p class="text-gray-600 mt-1">@yield('page-description')</p>
                                    @endif
                                </div>
                            @endif
                            
                            <!-- Content -->
                            @yield('content')
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    @if(auth()->check())
                        @include('partials.footer')
                    @endif
                </div>
            </main>
        </div>
    </div>
    
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
            
            // User dropdown toggle
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', function() {
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
            
            // Notifications dropdown
            const notificationButton = document.getElementById('notificationButton');
            const notificationDropdown = document.getElementById('notificationDropdown');
            
            if (notificationButton && notificationDropdown) {
                notificationButton.addEventListener('click', function() {
                    notificationDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                        notificationDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>