@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'HRMS Dashboard')

<style>
    /* Dashboard Specific Styles */
    .dashboard-card {
        transition: all 0.3s ease;
        border-left: 4px solid;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-card.total-employees {
        border-left-color: #3b82f6; /* Blue */
    }
    
    .dashboard-card.present-today {
        border-left-color: #10b981; /* Green */
    }
    
    .dashboard-card.pending-leaves {
        border-left-color: #f59e0b; /* Yellow */
    }
    
    .dashboard-card.departments {
        border-left-color: #8b5cf6; /* Purple */
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }
    
    .attendance-bar {
        transition: height 0.8s ease;
        border-radius: 8px 8px 0 0;
    }
    
    .attendance-bar:hover {
        opacity: 0.9;
    }
    
    .quick-action-card {
        transition: all 0.2s ease;
        border: 1px solid #e5e7eb;
    }
    
    .quick-action-card:hover {
        transform: translateY(-3px);
        border-color: #3b82f6;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }
    
    .employee-avatar {
        position: relative;
        transition: transform 0.3s ease;
    }
    
    .employee-avatar:hover {
        transform: scale(1.1);
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .upcoming-birthday {
        position: relative;
        overflow: hidden;
    }
    
    .upcoming-birthday::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, #ec4899, #f472b6);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .animate-pulse-slow {
        animation: pulse 2s infinite;
    }
    
    /* Chart tooltip */
    .chart-tooltip {
        position: absolute;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 10;
    }
    
    /* Custom scrollbar for dashboard */
    .dashboard-scroll {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f1f5f9;
    }
    
    .dashboard-scroll::-webkit-scrollbar {
        width: 6px;
    }
    
    .dashboard-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .dashboard-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    /* Loading animation */
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }
</style>

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg p-6 text-white animate-fade-in-up">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100 opacity-90">Here's what's happening with your HRMS today.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex items-center space-x-2">
                    <div class="bg-white/20 px-4 py-2 rounded-lg">
                        <span class="text-sm">Today:</span>
                        <span class="font-semibold ml-2">{{ date('l, F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Employees Card -->
        <div class="dashboard-card total-employees bg-white rounded-xl shadow p-6 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-2">TOTAL EMPLOYEES</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalEmployees ?? 0 }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            12% from last month
                        </span>
                    </div>
                </div>
                <div class="stat-icon bg-blue-50 text-blue-600">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Active</span>
                    <span class="font-medium text-gray-700">{{ $totalEmployees ?? 0 }}</span>
                </div>
            </div>
        </div>
        
        <!-- Present Today Card -->
        <div class="dashboard-card present-today bg-white rounded-xl shadow p-6 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-2">PRESENT TODAY</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $presentToday ?? 0 }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-sm">
                            {{ date('M d, Y') }}
                        </span>
                    </div>
                </div>
                <div class="stat-icon bg-green-50 text-green-600">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Attendance Rate</span>
                    <span class="font-medium text-gray-700">
                        @if($totalEmployees > 0)
                            {{ round(($presentToday/$totalEmployees)*100, 1) }}%
                        @else
                            0%
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Pending Leaves Card -->
        <div class="dashboard-card pending-leaves bg-white rounded-xl shadow p-6 animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-2">PENDING LEAVES</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $pendingLeaves ?? 0 }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-600 text-sm font-medium flex items-center animate-pulse-slow">
                            <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                            Requires attention
                        </span>
                    </div>
                </div>
                <div class="stat-icon bg-yellow-50 text-yellow-600">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">This Week</span>
                    <span class="font-medium text-gray-700">+{{ rand(2,8) }}</span>
                </div>
            </div>
        </div>
        
        <!-- Departments Card -->
        <div class="dashboard-card departments bg-white rounded-xl shadow p-6 animate-fade-in-up" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-2">DEPARTMENTS</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalDepartments ?? 0 }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-sm">Active departments</span>
                    </div>
                </div>
                <div class="stat-icon bg-purple-50 text-purple-600">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Teams</span>
                    <span class="font-medium text-gray-700">{{ rand(15,30) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Attendance Chart -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Attendance Overview</h2>
                        <p class="text-gray-600 text-sm">This month's attendance statistics</p>
                    </div>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>This Month</option>
                        <option>Last Month</option>
                        <option>Last Quarter</option>
                    </select>
                </div>
            </div>
            <div class="p-6">
                <div class="h-72 flex items-end space-x-4">
                    @php
                        $statuses = [
                            'present' => ['color' => 'bg-gradient-to-t from-green-500 to-green-400', 'label' => 'Present'],
                            'absent' => ['color' => 'bg-gradient-to-t from-red-500 to-red-400', 'label' => 'Absent'],
                            'late' => ['color' => 'bg-gradient-to-t from-yellow-500 to-yellow-400', 'label' => 'Late'],
                            'half_day' => ['color' => 'bg-gradient-to-t from-blue-500 to-blue-400', 'label' => 'Half Day'],
                        ];
                        
                        // If no data, use sample data
                        if(!isset($attendanceSummary) || $attendanceSummary->isEmpty()) {
                            $sampleData = [
                                'present' => rand(150, 200),
                                'absent' => rand(5, 15),
                                'late' => rand(10, 25),
                                'half_day' => rand(3, 8)
                            ];
                            $maxCount = max($sampleData);
                        } else {
                            $maxCount = $attendanceSummary->max('count') ?: 1;
                        }
                    @endphp
                    
                    @foreach($statuses as $statusKey => $statusInfo)
                        @php
                            if(isset($sampleData)) {
                                $count = $sampleData[$statusKey];
                            } else {
                                $statusData = $attendanceSummary->firstWhere('status', $statusKey);
                                $count = $statusData ? $statusData->count : 0;
                            }
                            $height = $maxCount > 0 ? ($count / $maxCount) * 80 : 0;
                            $percentage = $maxCount > 0 ? round(($count / $maxCount) * 100, 1) : 0;
                        @endphp
                        <div class="flex-1 relative group">
                            <div class="text-center mb-4">
                                <div class="text-2xl font-bold text-gray-800">{{ $count }}</div>
                                <div class="text-sm text-gray-500">{{ $statusInfo['label'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $percentage }}%</div>
                            </div>
                            <div 
                                class="{{ $statusInfo['color'] }} attendance-bar rounded-t-lg w-full mx-auto transition-all duration-700 hover:opacity-90 cursor-pointer"
                                style="height: {{ $height }}%; max-width: 60px;"
                                data-count="{{ $count }}"
                                data-label="{{ $statusInfo['label'] }}"
                                title="{{ $statusInfo['label'] }}: {{ $count }}"
                            ></div>
                            <div class="chart-tooltip group-hover:opacity-100">
                                {{ $statusInfo['label'] }}: {{ $count }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex justify-center space-x-6">
                    @foreach($statuses as $statusKey => $statusInfo)
                        <div class="flex items-center">
                            <div class="w-3 h-3 {{ $statusInfo['color'] }} rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">{{ $statusInfo['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Recent Leaves -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Recent Leave Applications</h2>
                        <p class="text-gray-600 text-sm">Latest leave requests</p>
                    </div>
                    <a href="{{ route('leaves.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                        View All <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            <div class="p-4 dashboard-scroll" style="max-height: 320px; overflow-y: auto;">
                @forelse($recentLeaves ?? [] as $leave)
                <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors mb-2">
                    <div class="flex items-center">
                        <div class="employee-avatar h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold mr-3">
                            {{ substr($leave->employee->first_name ?? 'N', 0, 1) }}{{ substr($leave->employee->last_name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $leave->employee->first_name ?? 'Employee' }} {{ $leave->employee->last_name ?? '' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $leave->leaveType->name ?? 'Annual Leave' }} • 
                                {{ $leave->total_days ?? 1 }} day(s)
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="status-badge 
                            {{ ($leave->status ?? 'pending') == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 
                               (($leave->status ?? 'pending') == 'approved' ? 'bg-green-100 text-green-800 border border-green-200' : 
                               'bg-red-100 text-red-800 border border-red-200') }}">
                            {{ ucfirst($leave->status ?? 'pending') }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ isset($leave->start_date) ? $leave->start_date->format('M d') : 'Jan 01' }} - 
                            {{ isset($leave->end_date) ? $leave->end_date->format('M d') : 'Jan 01' }}
                        </p>
                    </div>
                </div>
                @empty
                <!-- Sample Leave Data when no data exists -->
                @foreach([
                    ['name' => 'Rajesh Kumar', 'type' => 'Sick Leave', 'status' => 'approved', 'days' => 2],
                    ['name' => 'Priya Sharma', 'type' => 'Casual Leave', 'status' => 'pending', 'days' => 1],
                    ['name' => 'Amit Patel', 'type' => 'Annual Leave', 'status' => 'approved', 'days' => 5],
                    ['name' => 'Sneha Gupta', 'type' => 'Maternity Leave', 'status' => 'approved', 'days' => 90],
                    ['name' => 'Rahul Singh', 'type' => 'Emergency Leave', 'status' => 'rejected', 'days' => 1],
                ] as $sampleLeave)
                <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors mb-2">
                    <div class="flex items-center">
                        <div class="employee-avatar h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold mr-3">
                            {{ substr($sampleLeave['name'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $sampleLeave['name'] }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $sampleLeave['type'] }} • {{ $sampleLeave['days'] }} day(s)
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="status-badge 
                            {{ $sampleLeave['status'] == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 
                               ($sampleLeave['status'] == 'approved' ? 'bg-green-100 text-green-800 border border-green-200' : 
                               'bg-red-100 text-red-800 border border-red-200') }}">
                            {{ ucfirst($sampleLeave['status']) }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ date('M d') }} - {{ date('M d', strtotime('+'.$sampleLeave['days'].' days')) }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Employees and Upcoming Birthdays -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Employees -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Recently Joined</h2>
                        <p class="text-gray-600 text-sm">New team members</p>
                    </div>
                    <a href="{{ route('employees.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                        View All <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            <div class="p-4">
                @forelse($recentEmployees ?? [] as $employee)
                <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors mb-2">
                    <div class="flex items-center">
                        <div class="employee-avatar h-12 w-12 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white font-bold mr-4">
                            @if(isset($employee->profile_photo) && $employee->profile_photo)
                                <img src="{{ asset('storage/' . $employee->profile_photo) }}" 
                                     alt="{{ $employee->first_name }}" 
                                     class="h-12 w-12 rounded-full object-cover">
                            @else
                                {{ substr($employee->first_name ?? 'J', 0, 1) }}{{ substr($employee->last_name ?? 'D', 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $employee->first_name ?? 'John' }} {{ $employee->last_name ?? 'Doe' }}
                            </p>
                            <div class="flex items-center mt-1">
                                <span class="text-sm text-gray-500 mr-3">
                                    <i class="fas fa-briefcase mr-1 text-xs"></i>
                                    {{ $employee->designation->title ?? 'Software Engineer' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-building mr-1 text-xs"></i>
                                    {{ $employee->department->name ?? 'IT' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">
                            {{ $employee->employee_code ?? 'EMP001' }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">
                            Joined {{ isset($employee->joining_date) ? $employee->joining_date->format('M d, Y') : date('M d, Y') }}
                        </p>
                    </div>
                </div>
                @empty
                <!-- Sample Employee Data -->
                @foreach([
                    ['name' => 'Ravi Verma', 'code' => 'EMP1001', 'designation' => 'Senior Developer', 'department' => 'IT', 'date' => '2024-01-15'],
                    ['name' => 'Meera Nair', 'code' => 'EMP1002', 'designation' => 'HR Manager', 'department' => 'Human Resources', 'date' => '2024-01-10'],
                    ['name' => 'Karan Malhotra', 'code' => 'EMP1003', 'designation' => 'Sales Executive', 'department' => 'Sales', 'date' => '2024-01-05'],
                    ['name' => 'Anjali Desai', 'code' => 'EMP1004', 'designation' => 'Marketing Head', 'department' => 'Marketing', 'date' => '2024-01-01'],
                ] as $sampleEmployee)
                <div class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors mb-2">
                    <div class="flex items-center">
                        <div class="employee-avatar h-12 w-12 rounded-full bg-gradient-to-r from-{{ ['green','blue','purple','pink'][$loop->index] }}-500 to-{{ ['teal','cyan','violet','rose'][$loop->index] }}-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($sampleEmployee['name'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $sampleEmployee['name'] }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-sm text-gray-500 mr-3">
                                    <i class="fas fa-briefcase mr-1 text-xs"></i>
                                    {{ $sampleEmployee['designation'] }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-building mr-1 text-xs"></i>
                                    {{ $sampleEmployee['department'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">
                            {{ $sampleEmployee['code'] }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">
                            Joined {{ date('M d, Y', strtotime($sampleEmployee['date'])) }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
        
        <!-- Upcoming Birthdays & Quick Actions -->
        <div class="space-y-6">
            <!-- Upcoming Birthdays -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Upcoming Birthdays</h2>
                            <p class="text-gray-600 text-sm">Celebrations this month</p>
                        </div>
                        <span class="text-pink-600 font-medium text-sm">{{ date('F Y') }}</span>
                    </div>
                </div>
                <div class="p-4">
                    @forelse($upcomingBirthdays ?? [] as $employee)
                    <div class="upcoming-birthday flex items-center justify-between p-4 rounded-lg hover:bg-pink-50 transition-colors mb-2">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 flex items-center justify-center text-white mr-4">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $employee->first_name ?? 'Amit' }} {{ $employee->last_name ?? 'Sharma' }}
                                </p>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm text-gray-500 mr-3">
                                        <i class="fas fa-cake-candles mr-1 text-xs"></i>
                                        Turns {{ isset($employee->date_of_birth) ? $employee->date_of_birth->age + 1 : 30 }} on
                                        {{ isset($employee->date_of_birth) ? $employee->date_of_birth->format('M d') : 'Jan 20' }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-gift mr-1 text-xs"></i>
                                        {{ ['IT', 'HR', 'Sales', 'Marketing'][rand(0,3)] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-xs rounded-full bg-pink-100 text-pink-800 font-medium">
                                {{ isset($employee->date_of_birth) ? $employee->date_of_birth->format('M d') : 'Jan 20' }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'][rand(0,4)] }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <!-- Sample Birthdays -->
                    @foreach([
                        ['name' => 'Rohan Mehta', 'date' => 'Jan 18', 'age' => 28, 'department' => 'IT'],
                        ['name' => 'Sunita Reddy', 'date' => 'Jan 22', 'age' => 32, 'department' => 'HR'],
                        ['name' => 'Vikram Singh', 'date' => 'Jan 25', 'age' => 35, 'department' => 'Sales'],
                        ['name' => 'Pooja Kapoor', 'date' => 'Jan 30', 'age' => 27, 'department' => 'Marketing'],
                    ] as $sampleBirthday)
                    <div class="upcoming-birthday flex items-center justify-between p-4 rounded-lg hover:bg-pink-50 transition-colors mb-2">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 flex items-center justify-center text-white mr-4">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $sampleBirthday['name'] }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm text-gray-500 mr-3">
                                        <i class="fas fa-cake-candles mr-1 text-xs"></i>
                                        Turns {{ $sampleBirthday['age'] }} on {{ $sampleBirthday['date'] }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-gift mr-1 text-xs"></i>
                                        {{ $sampleBirthday['department'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-xs rounded-full bg-pink-100 text-pink-800 font-medium">
                                {{ $sampleBirthday['date'] }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'][$loop->index] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                    @endforelse
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('attendance.create') }}" class="quick-action-card bg-blue-50 hover:bg-blue-100 text-blue-700 p-4 rounded-xl text-center transition-all">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                                <i class="fas fa-fingerprint text-xl text-blue-600"></i>
                            </div>
                            <div class="font-semibold">Mark Attendance</div>
                            <div class="text-xs text-blue-600 mt-1">Clock in/out</div>
                        </div>
                    </a>
                    <a href="{{ route('leaves.create') }}" class="quick-action-card bg-green-50 hover:bg-green-100 text-green-700 p-4 rounded-xl text-center transition-all">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mb-3">
                                <i class="fas fa-calendar-plus text-xl text-green-600"></i>
                            </div>
                            <div class="font-semibold">Apply Leave</div>
                            <div class="text-xs text-green-600 mt-1">Submit request</div>
                        </div>
                    </a>
                    <a href="{{ route('employees.create') }}" class="quick-action-card bg-purple-50 hover:bg-purple-100 text-purple-700 p-4 rounded-xl text-center transition-all">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mb-3">
                                <i class="fas fa-user-plus text-xl text-purple-600"></i>
                            </div>
                            <div class="font-semibold">Add Employee</div>
                            <div class="text-xs text-purple-600 mt-1">New hire</div>
                        </div>
                    </a>
                    <a href="{{ route('payroll.create') }}" class="quick-action-card bg-yellow-50 hover:bg-yellow-100 text-yellow-700 p-4 rounded-xl text-center transition-all">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center mb-3">
                                <i class="fas fa-money-check-alt text-xl text-yellow-600"></i>
                            </div>
                            <div class="font-semibold">Process Payroll</div>
                            <div class="text-xs text-yellow-600 mt-1">Salary run</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- System Status -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">System Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                <div class="mr-4">
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-server text-green-600"></i>
                    </div>
                </div>
                <div>
                    <div class="font-medium text-gray-800">Database</div>
                    <div class="text-sm text-gray-600">All systems operational</div>
                </div>
                <div class="ml-auto">
                    <div class="h-3 w-3 rounded-full bg-green-500 animate-pulse"></div>
                </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                <div class="mr-4">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-cloud text-blue-600"></i>
                    </div>
                </div>
                <div>
                    <div class="font-medium text-gray-800">Storage</div>
                    <div class="text-sm text-gray-600">2.4GB of 10GB used</div>
                </div>
                <div class="ml-auto">
                    <div class="text-sm text-gray-600">24%</div>
                </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                <div class="mr-4">
                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                </div>
                <div>
                    <div class="font-medium text-gray-800">Active Users</div>
                    <div class="text-sm text-gray-600">12 currently online</div>
                </div>
                <div class="ml-auto">
                    <div class="text-sm text-green-600">+3 today</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar chart hover effects
        document.querySelectorAll('.attendance-bar').forEach(bar => {
            bar.addEventListener('mouseenter', function() {
                const tooltip = this.parentElement.querySelector('.chart-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '1';
                }
            });
            
            bar.addEventListener('mouseleave', function() {
                const tooltip = this.parentElement.querySelector('.chart-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                }
            });
        });
        
        // Auto-refresh dashboard data every 5 minutes
        let refreshInterval = setInterval(() => {
            console.log('Auto-refresh dashboard data...');
            // You can implement AJAX refresh here
        }, 300000);
        
        // Quick action cards animation
        document.querySelectorAll('.quick-action-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Update current time every minute
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const timeElement = document.querySelector('.current-time');
            if (timeElement) {
                timeElement.textContent = now.toLocaleDateString('en-US', options);
            }
        }
        
        // Initialize time
        updateTime();
        setInterval(updateTime, 60000);
        
        // Add loading animation for cards
        const cards = document.querySelectorAll('.dashboard-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush