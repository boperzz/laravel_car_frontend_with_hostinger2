@php
    use Illuminate\Support\Facades\Storage;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-car mr-2"></i>My Vehicles
            </h2>
            <a href="{{ route('customer.vehicles.create') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>Add Vehicle
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Add Vehicle Button - Prominent -->
        <div class="mb-6 flex justify-end">
            <a href="{{ route('customer.vehicles.create') }}" class="inline-flex items-center border-2 border-black bg-transparent hover:bg-black text-black hover:text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                <span>Add New Vehicle</span>
            </a>
        </div>

        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $vehicle)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                        <div class="p-6">
                            @if($vehicle->picture)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($vehicle->picture) }}" alt="Vehicle Picture" class="w-full h-48 object-cover rounded-lg border border-gray-300" onerror="this.style.display='none';">
                                </div>
                            @endif
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $vehicle->full_name }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-id-card mr-1"></i>{{ $vehicle->license_plate }}
                                    </p>
                                </div>
                                @if($vehicle->color)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $vehicle->color }}
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2 mb-4">
                                @if($vehicle->vin)
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-barcode mr-2"></i>VIN: {{ $vehicle->vin }}
                                    </p>
                                @endif
                                @if($vehicle->mileage)
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-tachometer-alt mr-2"></i>{{ number_format($vehicle->mileage) }} miles
                                    </p>
                                @endif
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    {{ $vehicle->appointments->count() }} appointment(s)
                                </p>
                            </div>

                            @if($vehicle->notes)
                                <p class="text-sm text-gray-500 italic mb-4">{{ Str::limit($vehicle->notes, 100) }}</p>
                            @endif

                            <div class="flex space-x-2">
                                <a href="{{ route('customer.vehicles.show', $vehicle) }}" class="flex-1 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-2 rounded transition">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                                <a href="{{ route('customer.vehicles.edit', $vehicle) }}" class="flex-1 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white text-center px-4 py-2 rounded transition">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('customer.vehicles.destroy', $vehicle) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $vehicles->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-car text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Vehicles Yet</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first vehicle.</p>
                <a href="{{ route('customer.vehicles.create') }}" class="inline-block border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-6 py-3 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Add Your First Vehicle
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

