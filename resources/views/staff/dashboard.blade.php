<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-tachometer-alt mr-2"></i>Staff Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['today_appointments'] }}</p>
                    </div>
                </div>
            </div>

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

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Upcoming</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['upcoming_appointments'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Completed Today</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_today'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Today's Appointments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-calendar-day mr-2"></i>Today's Appointments
                    </h3>
                </div>
                <div class="p-6">
                    @if($todayAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($todayAppointments as $appointment)
                                <div class="border-l-4 border-blue-500 pl-4 py-2 hover:bg-gray-50 rounded">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <a href="{{ route('staff.appointments.show', $appointment) }}" class="block">
                                                <p class="font-semibold text-gray-900">
                                                    {{ $appointment->appointment_date->format('h:i A') }} - {{ $appointment->vehicle->full_name }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-user mr-1"></i>{{ $appointment->user->name }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-wrench mr-1"></i>
                                                    {{ $appointment->services->pluck('name')->join(', ') }}
                                                </p>
                                            </a>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full ml-4
                                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-800
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
                        <p class="text-gray-500 text-center py-4">No appointments scheduled for today.</p>
                    @endif
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-calendar-check mr-2"></i>Upcoming Appointments
                    </h3>
                </div>
                <div class="p-6">
                    @if($upcomingAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingAppointments as $appointment)
                                <div class="border-l-4 border-purple-500 pl-4 py-2 hover:bg-gray-50 rounded">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <a href="{{ route('staff.appointments.show', $appointment) }}" class="block">
                                                <p class="font-semibold text-gray-900">
                                                    {{ $appointment->appointment_date->format('M d, h:i A') }}
                                                </p>
                                                <p class="text-sm text-gray-600">{{ $appointment->vehicle->full_name }}</p>
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-user mr-1"></i>{{ $appointment->user->name }}
                                                </p>
                                            </a>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full ml-4
                                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('staff.appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View All Appointments <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No upcoming appointments.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

