<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-calendar-check mr-2"></i>Appointment Details
            </h2>
            <a href="{{ route('staff.appointments.index') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Appointment Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Appointment Details -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Appointment Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Date & Time</label>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $appointment->appointment_date->format('l, F d, Y') }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $appointment->appointment_date->format('h:i A') }} - {{ $appointment->end_time->format('h:i A') }}
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
                            <label class="block text-sm font-medium text-gray-600 mb-1">Customer</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $appointment->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Total Price</label>
                            <p class="text-2xl font-bold text-blue-600">${{ number_format($appointment->total_price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Information -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-car mr-2"></i>Vehicle Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Vehicle</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $appointment->vehicle->full_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">License Plate</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $appointment->vehicle->license_plate }}</p>
                        </div>

                        @if($appointment->vehicle->vin)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">VIN</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $appointment->vehicle->vin }}</p>
                        </div>
                        @endif

                        @if($appointment->vehicle->mileage)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Mileage</label>
                            <p class="text-lg font-semibold text-gray-900">{{ number_format($appointment->vehicle->mileage) }} miles</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Services -->
                <div class="bg-white rounded-lg shadow p-6">
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
                                <label class="block text-sm font-medium text-gray-600 mb-1">Customer Notes</label>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $appointment->notes }}</p>
                            </div>
                        @endif
                        @if($appointment->staff_notes)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Your Notes</label>
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
                @if($appointment->staff_id == Auth::id())
                    <!-- Update Status - Only show if staff is assigned -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-edit mr-2"></i>Update Status
                        </h3>
                        <form action="{{ route('staff.appointments.update-status', $appointment) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="in_progress" {{ $appointment->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <p class="text-sm text-gray-500 mt-2">You can only update status to: Confirmed, In Progress, or Completed</p>
                            </div>
                            <button type="submit" class="w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                                <i class="fas fa-save mr-2"></i>Update Status
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Show message if not assigned -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg shadow p-6 mb-6">
                        <p class="text-yellow-800">
                            <i class="fas fa-info-circle mr-2"></i>This appointment is not assigned to you. Only assigned staff can update the status.
                        </p>
                    </div>
                @endif

                @if($appointment->staff_id == Auth::id())
                    <!-- Add Notes - Only show if staff is assigned -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-sticky-note mr-2"></i>Add Notes
                        </h3>
                        <form action="{{ route('staff.appointments.update-notes', $appointment) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <label for="staff_notes" class="block text-sm font-medium text-gray-700 mb-2">Staff Notes</label>
                                <textarea name="staff_notes" id="staff_notes" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="Add notes, findings, or recommendations...">{{ old('staff_notes', $appointment->staff_notes) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="service_results" class="block text-sm font-medium text-gray-700 mb-2">Service Results</label>
                                <textarea name="service_results" id="service_results" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="Describe completed work and results...">{{ old('service_results', $appointment->service_results) }}</textarea>
                            </div>
                            <button type="submit" class="w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                                <i class="fas fa-save mr-2"></i>Save Notes
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

