<!-- Sidebar -->
<aside id="sidebar" class="bg-white text-gray-800 w-64 flex-shrink-0 hidden lg:flex lg:flex-col lg:inset-y-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-30 shadow-md">
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-600 to-blue-800 flex items-center justify-center shadow-sm">
                <i class="fas fa-chart-line text-white text-lg"></i>
            </div>
            <div>
                <span class="text-xl font-bold text-gray-900">HRMS</span>
                <span class="text-xl font-bold text-blue-600">Pro</span>
            </div>
        </div>
        <button id="sidebarClose" class="lg:hidden text-gray-500 hover:text-gray-800">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                <i class="fas fa-tachometer-alt mr-3 text-gray-500 {{ request()->routeIs('dashboard') ? 'text-blue-600' : '' }}"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <!-- Employee Management -->
            <div class="mt-6">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">EMPLOYEE MANAGEMENT</p>
                <div class="space-y-1">
                    <a href="{{ route('employees.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <i class="fas fa-users mr-3 text-gray-500 {{ request()->routeIs('employees.*') ? 'text-blue-600' : '' }}"></i>
                        <span class="font-medium">Employees</span>
                    </a>
                    <a href="{{ route('attendance.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('attendance.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <i class="fas fa-calendar-check mr-3 text-gray-500 {{ request()->routeIs('attendance.*') ? 'text-blue-600' : '' }}"></i>
                        <span class="font-medium">Attendance</span>
                    </a>
                    <a href="{{ route('leaves.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('leaves.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <i class="fas fa-umbrella-beach mr-3 text-gray-500 {{ request()->routeIs('leaves.*') ? 'text-blue-600' : '' }}"></i>
                        <span class="font-medium">Leaves</span>
                    </a>
                </div>
            </div>
            
            <!-- Payroll & Finance -->
            <div class="mt-6">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">PAYROLL & FINANCE</p>
                <div class="space-y-1">
                    <a href="{{ route('payroll.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('payroll.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <i class="fas fa-money-check-alt mr-3 text-gray-500 {{ request()->routeIs('payroll.*') ? 'text-blue-600' : '' }}"></i>
                        <span class="font-medium">Payroll</span>
                    </a>
                    <a href="#" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 border-l-4 border-transparent">
                        <i class="fas fa-chart-line mr-3 text-gray-500"></i>
                        <span class="font-medium">Reports</span>
                    </a>
                </div>
            </div>
            
            <!-- Organization -->
            <div class="mt-6">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">ORGANIZATION</p>
                <div class="space-y-1">
                    <a href="{{ route('departments.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 {{ request()->routeIs('departments.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <i class="fas fa-building mr-3 text-gray-500 {{ request()->routeIs('departments.*') ? 'text-blue-600' : '' }}"></i>
                        <span class="font-medium">Departments</span>
                    </a>
                    <a href="#" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 border-l-4 border-transparent">
                        <i class="fas fa-briefcase mr-3 text-gray-500"></i>
                        <span class="font-medium">Designations</span>
                    </a>
                </div>
            </div>
            
            <!-- System -->
            <div class="mt-6">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">SYSTEM</p>
                <div class="space-y-1">
                    <a href="#" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 border-l-4 border-transparent">
                        <i class="fas fa-cog mr-3 text-gray-500"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    <a href="#" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 border-l-4 border-transparent">
                        <i class="fas fa-user-shield mr-3 text-gray-500"></i>
                        <span class="font-medium">Roles & Permissions</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="border-t border-gray-200 p-4 bg-gray-50">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-headset text-blue-600"></i>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Need help?</p>
                <a href="#" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Contact Support</a>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-30 z-20 lg:hidden hidden backdrop-blur-sm"></div>

<!-- Mobile Toggle Button (Add this to your header/navbar) -->
<button id="sidebarToggle" class="lg:hidden p-2 text-gray-700 hover:text-gray-900">
    <i class="fas fa-bars text-xl"></i>
</button>