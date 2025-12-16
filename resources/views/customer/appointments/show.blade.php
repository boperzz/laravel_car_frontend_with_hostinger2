<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-calendar-check mr-2"></i>Appointment Details
            </h2>
            <div class="flex space-x-2">
                @if($appointment->canBeRescheduled())
                    <a href="{{ route('customer.appointments.edit', $appointment) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                        <i class="fas fa-edit mr-2"></i>Reschedule
                    </a>
                @endif
                <a href="{{ route('customer.appointments.index') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Appointment Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Appointment Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Date & Time</label>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $appointment->appointment_date->format('M d, Y h:i A') }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                Ends: {{ $appointment->end_time->format('h:i A') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-800
                                @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Vehicle</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $appointment->vehicle->full_name }}</p>
                            <p class="text-sm text-gray-500">{{ $appointment->vehicle->license_plate }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Assigned Staff</label>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $appointment->staff ? $appointment->staff->name : 'Not Assigned Yet' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Total Price</label>
                            <p class="text-2xl font-bold text-blue-600">${{ number_format($appointment->total_price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-wrench mr-2"></i>Services
                    </h3>
                    <div class="space-y-3">
                        @foreach($appointment->services as $service)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $service->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $service->duration_minutes }} minutes</p>
                                </div>
                                <p class="font-semibold text-blue-600">${{ number_format($service->pivot->price, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Notes -->
                @if($appointment->notes || $appointment->staff_notes || $appointment->service_results)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-sticky-note mr-2"></i>Notes
                        </h3>
                        @if($appointment->notes)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Your Notes</label>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $appointment->notes }}</p>
                            </div>
                        @endif
                        @if($appointment->staff_notes)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Staff Notes</label>
                                <p class="text-gray-700 bg-blue-50 p-3 rounded-lg">{{ $appointment->staff_notes }}</p>
                            </div>
                        @endif
                        @if($appointment->service_results)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Service Results</label>
                                <p class="text-gray-700 bg-green-50 p-3 rounded-lg">{{ $appointment->service_results }}</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-bolt mr-2"></i>Actions
                    </h3>
                    <div class="space-y-3">
                        @if($appointment->canBeRescheduled())
                            <a href="{{ route('customer.appointments.edit', $appointment) }}" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition font-semibold">
                                <i class="fas fa-edit mr-2"></i>Reschedule
                            </a>
                        @endif
                        @if($appointment->canBeCancelled())
                            <form action="{{ route('customer.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition font-semibold">
                                    <i class="fas fa-times mr-2"></i>Cancel Appointment
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('customer.vehicles.show', $appointment->vehicle) }}" class="block w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-3 rounded-lg transition font-semibold">
                            <i class="fas fa-car mr-2"></i>View Vehicle
                        </a>
                    </div>
                </div>

                <!-- Appointment Timeline -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-clock mr-2"></i>Timeline
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Created</p>
                            <p class="text-sm text-gray-900">{{ $appointment->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        @if($appointment->appointment_date->isFuture())
                            <div>
                                <p class="text-sm font-medium text-gray-600">Time Until Appointment</p>
                                <p class="text-sm text-gray-900">{{ $appointment->appointment_date->diffForHumans() }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

