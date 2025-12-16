<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-plus-circle mr-2"></i>Add New Vehicle
            </h2>
            <a href="{{ route('customer.vehicles.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i>Back to Vehicles
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('customer.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Make -->
                        <div>
                            <label for="make" class="block text-sm font-medium text-gray-700 mb-2">
                                Make <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="make" id="make" value="{{ old('make') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('make') border-red-500 @enderror"
                                placeholder="e.g., Toyota">
                            @error('make')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                                Model <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="model" id="model" value="{{ old('model') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('model') border-red-500 @enderror"
                                placeholder="e.g., Camry">
                            @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Year -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                                Year <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="year" id="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('year') border-red-500 @enderror"
                                placeholder="e.g., 2020">
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- License Plate -->
                        <div>
                            <label for="license_plate" class="block text-sm font-medium text-gray-700 mb-2">
                                License Plate <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('license_plate') border-red-500 @enderror"
                                placeholder="e.g., ABC-1234">
                            @error('license_plate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- VIN -->
                        <div>
                            <label for="vin" class="block text-sm font-medium text-gray-700 mb-2">
                                VIN (Optional)
                            </label>
                            <input type="text" name="vin" id="vin" value="{{ old('vin') }}" maxlength="17"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('vin') border-red-500 @enderror"
                                placeholder="17-character VIN">
                            @error('vin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                                Color (Optional)
                            </label>
                            <input type="text" name="color" id="color" value="{{ old('color') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror"
                                placeholder="e.g., Red, Blue">
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mileage -->
                        <div>
                            <label for="mileage" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Mileage (Optional)
                            </label>
                            <input type="number" name="mileage" id="mileage" value="{{ old('mileage') }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mileage') border-red-500 @enderror"
                                placeholder="e.g., 50000">
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
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror"
                            placeholder="Any additional information about your vehicle...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vehicle Picture -->
                    <div class="mt-6">
                        <label for="picture" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2"></i>Vehicle Picture <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
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
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('customer.vehicles.index') }}" class="px-6 py-3 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-semibold shadow-md hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i>Add Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

