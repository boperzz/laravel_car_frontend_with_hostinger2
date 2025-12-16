<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-calendar mr-2"></i>My Appointments
            </h2>
            <a href="{{ route('customer.appointments.create') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Book Appointment
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        @if($appointments->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Services</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($appointments as $appointment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $appointment->appointment_date->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $appointment->appointment_date->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $appointment->vehicle->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $appointment->vehicle->license_plate }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $appointment->services->pluck('name')->join(', ') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $appointment->staff ? $appointment->staff->name : 'Not Assigned' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-800
                                            @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                            @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($appointment->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('customer.appointments.show', $appointment) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium mr-2">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                        @if($appointment->canBeRescheduled())
                                            <a href="{{ route('customer.appointments.edit', $appointment) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium mr-2">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                        @endif
                                        @if($appointment->canBeCancelled())
                                            <form action="{{ route('customer.appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium">
                                                    <i class="fas fa-times mr-1"></i>Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Appointments Yet</h3>
                <p class="text-gray-500 mb-6">Book your first maintenance appointment.</p>
                <a href="{{ route('customer.appointments.create') }}" class="inline-block border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-6 py-3 rounded-lg transition font-semibold">
                    <i class="fas fa-calendar-plus mr-2"></i>Book Your First Appointment
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

