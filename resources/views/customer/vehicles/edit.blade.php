@php
    use Illuminate\Support\Facades\Storage;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-edit mr-2"></i>Edit Vehicle
            </h2>
            <a href="{{ route('customer.vehicles.show', $vehicle) }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i>Back to Vehicle
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('customer.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Make -->
                        <div>
                            <label for="make" class="block text-sm font-medium text-gray-700 mb-2">
                                Make <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="make" id="make" value="{{ old('make', $vehicle->make) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('make') border-red-500 @enderror">
                            @error('make')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                                Model <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="model" id="model" value="{{ old('model', $vehicle->model) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('model') border-red-500 @enderror">
                            @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Year -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                                Year <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="year" id="year" value="{{ old('year', $vehicle->year) }}" required min="1900" max="{{ date('Y') + 1 }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('year') border-red-500 @enderror">
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- License Plate -->
                        <div>
                            <label for="license_plate" class="block text-sm font-medium text-gray-700 mb-2">
                                License Plate <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('license_plate') border-red-500 @enderror">
                            @error('license_plate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- VIN -->
                        <div>
                            <label for="vin" class="block text-sm font-medium text-gray-700 mb-2">
                                VIN (Optional)
                            </label>
                            <input type="text" name="vin" id="vin" value="{{ old('vin', $vehicle->vin) }}" maxlength="17"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('vin') border-red-500 @enderror">
                            @error('vin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                                Color (Optional)
                            </label>
                            <input type="text" name="color" id="color" value="{{ old('color', $vehicle->color) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror">
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mileage -->
                        <div>
                            <label for="mileage" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Mileage (Optional)
                            </label>
                            <input type="number" name="mileage" id="mileage" value="{{ old('mileage', $vehicle->mileage) }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mileage') border-red-500 @enderror">
                            @error('mileage')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes', $vehicle->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vehicle Picture -->
                    <div class="mt-6">
                        <label for="picture" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2"></i>Vehicle Picture <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        @if($vehicle->picture)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-xs font-medium text-gray-600 mb-2">Current picture:</p>
                                <img src="{{ Storage::url($vehicle->picture) }}" alt="Vehicle Picture" class="w-full h-48 object-cover rounded-lg border-2 border-gray-300" onerror="this.style.display='none';">
                            </div>
                        @endif
                        <div class="relative">
                            <input 
                                type="file" 
                                name="picture" 
                                id="picture" 
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-2 file:border-black file:text-black file:bg-transparent file:hover:bg-black file:hover:text-white file:cursor-pointer file:transition file:font-semibold border-2 border-black rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('picture') border-red-500 @enderror"
                            >
                        </div>
                        @error('picture')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>Max file size: 5MB. Accepted formats: JPG, PNG, GIF
                        </p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('customer.vehicles.show', $vehicle) }}" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition">
                            <i class="fas fa-save mr-2"></i>Update Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

