<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Left: Menu Toggle and Breadcrumb -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Toggle -->
            <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Breadcrumb -->
            <div class="hidden md:flex items-center space-x-2 text-sm">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary">
                    <i class="fas fa-home"></i>
                </a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-800 font-medium">@yield('page-title', 'Dashboard')</span>
            </div>
        </div>
        
        <!-- Right: User Menu and Notifications -->
        <div class="flex items-center space-x-4">
            <!-- Search (Desktop Only) -->
            <div class="hidden lg:block relative">
                <input type="text" placeholder="Search..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent w-64">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            
            <!-- Notifications -->
            <div class="relative">
                <button id="notificationButton" class="relative p-2 text-gray-600 hover:text-primary">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                </button>
                
                <!-- Notification Dropdown -->
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-800">Notifications</h3>
                        <span class="text-sm text-gray-500">You have 3 unread</span>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        @foreach([
                            ['icon' => 'calendar-check', 'color' => 'text-green-600', 'title' => 'New Leave Request', 'time' => '10 min ago'],
                            ['icon' => 'user-plus', 'color' => 'text-blue-600', 'title' => 'New Employee Added', 'time' => '1 hour ago'],
                            ['icon' => 'money-check-alt', 'color' => 'text-yellow-600', 'title' => 'Payroll Processed', 'time' => '2 hours ago'],
                            ['icon' => 'exclamation-circle', 'color' => 'text-red-600', 'title' => 'System Alert', 'time' => '5 hours ago']
                        ] as $notification)
                        <a href="#" class="flex items-start p-4 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-{{ $notification['icon'] }} {{ $notification['color'] }}"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $notification['title'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $notification['time'] }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="p-4 border-t border-gray-200">
                        <a href="#" class="block text-center text-primary hover:text-primary-dark font-medium">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Menu -->
            <div class="relative">
                <button id="userMenuButton" class="flex items-center space-x-3 focus:outline-none">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary to-purple-600 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500 capitalize">{{ Auth::user()->role ?? 'admin' }}</div>
                    </div>
                    <i class="fas fa-chevron-down text-gray-500 hidden md:block"></i>
                </button>
                
                <!-- User Dropdown -->
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-user-circle mr-3 text-gray-500"></i>
                            <span>Profile</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-cog mr-3 text-gray-500"></i>
                            <span>Settings</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-question-circle mr-3 text-gray-500"></i>
                            <span>Help & Support</span>
                        </a>
                    </div>
                    <div class="border-t border-gray-200 p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>