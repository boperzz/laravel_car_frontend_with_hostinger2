@php
    use Illuminate\Support\Facades\Storage;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-car mr-2"></i>Vehicle Details
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('customer.vehicles.edit', $vehicle) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('customer.vehicles.index') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Vehicles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Vehicle Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    @if($vehicle->picture)
                        <div class="mb-6">
                            <img src="{{ Storage::url($vehicle->picture) }}" alt="Vehicle Picture" class="w-full h-64 object-cover rounded-lg border border-gray-300" onerror="this.style.display='none';">
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Vehicle Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Make</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $vehicle->make }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Model</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $vehicle->model }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Year</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $vehicle->year }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">License Plate</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $vehicle->license_plate }}</p>
                        </div>

                        @if($vehicle->vin)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">VIN</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $vehicle->vin }}</p>
                            </div>
                        @endif

                        @if($vehicle->color)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Color</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $vehicle->color }}</p>
                            </div>
                        @endif

                        @if($vehicle->mileage)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Current Mileage</label>
                                <p class="text-lg font-semibold text-gray-900">{{ number_format($vehicle->mileage) }} miles</p>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Registered</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $vehicle->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    @if($vehicle->notes)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Notes</label>
                            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $vehicle->notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Service History -->
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-history mr-2"></i>Service History
                    </h3>

                    @if($vehicle->appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($vehicle->appointments->sortByDesc('appointment_date') as $appointment)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ $appointment->appointment_date->format('M d, Y h:i A') }}
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <i class="fas fa-wrench mr-1"></i>
                                                {{ $appointment->services->pluck('name')->join(', ') }}
                                            </p>
                                            @if($appointment->staff)
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-user-tie mr-1"></i>
                                                    Staff: {{ $appointment->staff->name }}
                                                </p>
                                            @endif
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
                                    @if($appointment->staff_notes)
                                        <p class="text-sm text-gray-500 mt-2 italic">{{ $appointment->staff_notes }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No service history yet.</p>
                        <a href="{{ route('customer.appointments.create', ['vehicle_id' => $vehicle->id]) }}" class="block text-center text-blue-600 hover:text-blue-800 font-medium">
                            Book First Service <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('customer.appointments.create', ['vehicle_id' => $vehicle->id]) }}" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition">
                            <i class="fas fa-calendar-plus mr-2"></i>Book Appointment
                        </a>
                        <a href="{{ route('customer.vehicles.edit', $vehicle) }}" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition">
                            <i class="fas fa-edit mr-2"></i>Edit Vehicle
                        </a>
                        <form action="{{ route('customer.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                                    <button type="submit" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition">
                                        <i class="fas fa-trash mr-2"></i>Delete Vehicle
                                    </button>
                        </form>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-bar mr-2"></i>Statistics
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Total Appointments</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $vehicle->appointments->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Completed Services</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $vehicle->appointments->where('status', 'completed')->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Upcoming Appointments</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $vehicle->appointments->where('status', '!=', 'cancelled')->where('appointment_date', '>=', now())->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

