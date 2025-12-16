<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Appointments -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_appointments'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Appointments -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_appointments'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Today's Appointments -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Today</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['today_appointments'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Customers</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_customers'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Staff -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <i class="fas fa-user-tie text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Staff Members</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_staff'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Vehicles -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gray-100 text-gray-600">
                        <i class="fas fa-car text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Vehicles</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_vehicles'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Appointments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-history mr-2"></i>Recent Appointments
                    </h3>
                    <a href="{{ route('admin.appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        View All
                    </a>
                </div>
                <div class="p-6">
                    @if($recentAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentAppointments as $appointment)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900">
                                                {{ $appointment->user->name }} - {{ $appointment->vehicle->full_name }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $appointment->appointment_date->format('M d, Y h:i A') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full ml-4
                                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No appointments yet.</p>
                    @endif
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-calendar-alt mr-2"></i>Upcoming (Next 7 Days)
                    </h3>
                </div>
                <div class="p-6">
                    @if($upcomingAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingAppointments as $appointment)
                                <div class="border-l-4 border-green-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900">
                                                {{ $appointment->appointment_date->format('M d') }} - {{ $appointment->user->name }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{ $appointment->vehicle->full_name }}</p>
                                            @if($appointment->staff)
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-user-tie mr-1"></i>{{ $appointment->staff->name }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No upcoming appointments.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bolt mr-2"></i>Quick Actions
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.staff.index') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                    <i class="fas fa-users text-2xl text-blue-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">Manage Staff</p>
                        <p class="text-sm text-gray-600">Add or edit staff</p>
                    </div>
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                    <i class="fas fa-wrench text-2xl text-green-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">Manage Services</p>
                        <p class="text-sm text-gray-600">Service types & prices</p>
                    </div>
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                    <i class="fas fa-calendar-alt text-2xl text-purple-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">View Appointments</p>
                        <p class="text-sm text-gray-600">All appointments</p>
                    </div>
                </a>
                <a href="{{ route('admin.schedule.index') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition">
                    <i class="fas fa-calendar-times text-2xl text-yellow-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">Shop Schedule</p>
                        <p class="text-sm text-gray-600">Hours & blackouts</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

