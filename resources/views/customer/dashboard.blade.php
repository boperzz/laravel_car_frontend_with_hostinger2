<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-car text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Vehicles</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['vehicles_count'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['appointments_count'] }}</p>
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
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Appointments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-calendar mr-2"></i>Recent Appointments
                    </h3>
                </div>
                <div class="p-6">
                    @if($recentAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentAppointments as $appointment)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $appointment->vehicle->full_name }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-calendar mr-1"></i>
                                                {{ $appointment->appointment_date->format('M d, Y h:i A') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-wrench mr-1"></i>
                                                {{ $appointment->services->pluck('name')->join(', ') }}
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                            @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('customer.appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View All Appointments <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No appointments yet.</p>
                        <a href="{{ route('customer.appointments.create') }}" class="block text-center text-blue-600 hover:text-blue-800 font-medium">
                            Book Your First Appointment <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Recent Vehicles -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-car mr-2"></i>My Vehicles
                    </h3>
                </div>
                <div class="p-6">
                    @if($recentVehicles->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentVehicles as $vehicle)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $vehicle->full_name }}</p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-id-card mr-1"></i>{{ $vehicle->license_plate }}
                                            </p>
                                            @if($vehicle->mileage)
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-tachometer-alt mr-1"></i>{{ number_format($vehicle->mileage) }} miles
                                                </p>
                                            @endif
                                        </div>
                                        <a href="{{ route('customer.vehicles.show', $vehicle) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('customer.vehicles.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View All Vehicles <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No vehicles registered yet.</p>
                        <a href="{{ route('customer.vehicles.create') }}" class="block text-center text-blue-600 hover:text-blue-800 font-medium">
                            Add Your First Vehicle <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bolt mr-2"></i>Quick Actions
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('customer.vehicles.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                    <i class="fas fa-plus-circle text-2xl text-blue-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">Add Vehicle</p>
                        <p class="text-sm text-gray-600">Register a new vehicle</p>
                    </div>
                </a>
                <a href="{{ route('customer.appointments.create') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                    <i class="fas fa-calendar-plus text-2xl text-green-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">Book Appointment</p>
                        <p class="text-sm text-gray-600">Schedule maintenance</p>
                    </div>
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="flex items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                    <i class="fas fa-list text-2xl text-purple-600 mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-900">View Appointments</p>
                        <p class="text-sm text-gray-600">Manage bookings</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

