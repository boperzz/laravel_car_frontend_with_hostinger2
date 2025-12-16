<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800"><i class="fas fa-calendar-times mr-2"></i>Shop Schedule</h2></x-slot>
    <div class="py-6 space-y-6">
        <!-- Staff Schedules -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Staff Schedules</h3>
            @foreach($staffMembers as $staff)
                <div class="mb-6 border-b pb-4">
                    <h4 class="font-medium mb-2">{{ $staff->name }}</h4>
                    @foreach(['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] as $day)
                        @php $schedule = $staff->staffSchedules->where('day_of_week', $day)->first(); @endphp
                        <form action="{{ route('admin.schedule.staff.store') }}" method="POST" class="inline-block mr-2 mb-2">
                            @csrf
                            <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                            <input type="hidden" name="day_of_week" value="{{ $day }}">
                            <span class="text-sm w-24 inline-block">{{ ucfirst($day) }}:</span>
                            <input type="time" name="start_time" value="{{ $schedule ? $schedule->start_time->format('H:i') : '09:00' }}" class="border rounded px-2 py-1 text-sm">
                            <input type="time" name="end_time" value="{{ $schedule ? $schedule->end_time->format('H:i') : '17:00' }}" class="border rounded px-2 py-1 text-sm">
                            <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded text-sm transition font-medium">Save</button>
                        </form>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Blackout Dates -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Blackout Dates</h3>
            <form action="{{ route('admin.schedule.blackout.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex gap-4">
                    <input type="date" name="date" required class="border rounded px-3 py-2">
                    <input type="text" name="reason" placeholder="Reason" class="border rounded px-3 py-2">
                    <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                        <i class="fas fa-ban mr-2"></i>Add Blackout
                    </button>
                </div>
            </form>
            <div class="space-y-2">
                @foreach($blackoutDates as $date)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <span>{{ $date->date->format('M d, Y') }} - {{ $date->reason }}</span>
                        <form action="{{ route('admin.schedule.blackout.destroy', $date) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded text-sm transition font-medium">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

