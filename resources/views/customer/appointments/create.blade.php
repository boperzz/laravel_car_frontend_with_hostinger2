<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-calendar-plus mr-2"></i>Book Appointment
            </h2>
            <a href="{{ route('customer.appointments.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i>Back to Appointments
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('customer.appointments.store') }}" method="POST" id="appointment-form">
                    @csrf

                    <!-- Vehicle Selection -->
                    <div class="mb-6">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Vehicle <span class="text-red-500">*</span>
                        </label>
                        <select name="vehicle_id" id="vehicle_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('vehicle_id') border-red-500 @enderror">
                            <option value="">Choose a vehicle...</option>
                            @foreach(auth()->user()->vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', request('vehicle_id')) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->full_name }} - {{ $vehicle->license_plate }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if(auth()->user()->vehicles->count() == 0)
                            <p class="mt-2 text-sm text-yellow-600">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                No vehicles registered. <a href="{{ route('customer.vehicles.create') }}" class="text-blue-600 hover:underline">Add a vehicle first</a>.
                            </p>
                        @endif
                    </div>

                    <!-- Service Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Select Services <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(\App\Models\ServiceType::active()->get() as $service)
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                            class="mt-1 mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            {{ in_array($service->id, old('service_ids', [])) ? 'checked' : '' }}>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $service->name }}</p>
                                                    @if($service->description)
                                                        <p class="text-sm text-gray-600 mt-1">{{ $service->description }}</p>
                                                    @endif
                                                </div>
                                                <div class="text-right ml-4">
                                                    <p class="font-semibold text-blue-600">${{ number_format($service->price, 2) }}</p>
                                                    <p class="text-xs text-gray-500">{{ $service->duration_minutes }} min</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('service_ids')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if(\App\Models\ServiceType::active()->count() == 0)
                            <p class="text-sm text-yellow-600 mt-2">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                No services available. Please contact the administrator.
                            </p>
                        @endif
                    </div>

                    <!-- Date Selection -->
                    <div class="mb-6">
                        <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Appointment Date & Time <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" 
                            value="{{ old('appointment_date') }}" required
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('appointment_date') border-red-500 @enderror">
                        @error('appointment_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Shop hours: 8:00 AM - 6:00 PM
                        </p>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Notes (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror"
                            placeholder="Any special instructions or concerns...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Price Display -->
                    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Estimated Total:</span>
                            <span class="text-2xl font-bold text-blue-600" id="total-price">$0.00</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1" id="estimated-duration">Duration: 0 minutes</p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('customer.appointments.index') }}" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-semibold">
                            <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Calculate total price and duration
        function updateTotal() {
            const checkboxes = document.querySelectorAll('input[name="service_ids[]"]:checked');
            let total = 0;
            let duration = 0;

            checkboxes.forEach(checkbox => {
                const serviceCard = checkbox.closest('.border');
                if (!serviceCard) return;
                
                const priceElement = serviceCard.querySelector('.text-blue-600');
                const durationElement = serviceCard.querySelector('.text-gray-500');
                
                if (priceElement) {
                    const priceText = priceElement.textContent || '';
                    const price = parseFloat(priceText.replace('$', '').replace(/,/g, '')) || 0;
                    total += price;
                }
                
                if (durationElement) {
                    const durationText = durationElement.textContent || '';
                    const dur = parseInt(durationText.replace(' min', '')) || 0;
                    duration += dur;
                }
            });

            const totalPriceElement = document.getElementById('total-price');
            const durationElement = document.getElementById('estimated-duration');
            
            if (totalPriceElement) {
                totalPriceElement.textContent = '$' + total.toFixed(2);
            }
            if (durationElement) {
                durationElement.textContent = 'Duration: ' + duration + ' minutes';
            }
        }

        // Add event listeners to checkboxes
        document.querySelectorAll('input[name="service_ids[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
        });

        // Initial calculation
        updateTotal();
    </script>
    @endpush
</x-app-layout>

