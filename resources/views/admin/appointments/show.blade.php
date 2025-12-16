<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-check mr-2"></i>Appointment Details
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div><strong>Customer:</strong> {{ $appointment->user->name }}</div>
                <div><strong>Vehicle:</strong> {{ $appointment->vehicle->full_name }}</div>
                <div><strong>Date:</strong> {{ $appointment->appointment_date->format('M d, Y h:i A') }}</div>
                <div><strong>Status:</strong> {{ ucfirst($appointment->status) }}</div>
                <div><strong>Total:</strong> ${{ number_format($appointment->total_price, 2) }}</div>
            </div>

            <form action="{{ route('admin.appointments.assign-staff', $appointment) }}" method="POST" class="mt-4">
                @csrf
                <select name="staff_id" class="border rounded px-3 py-2">
                    <option value="">Select Staff</option>
                    @foreach($staffMembers as $staff)
                        <option value="{{ $staff->id }}" {{ $appointment->staff_id == $staff->id ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold ml-2">
                    <i class="fas fa-user-tie mr-2"></i>Assign Staff
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

