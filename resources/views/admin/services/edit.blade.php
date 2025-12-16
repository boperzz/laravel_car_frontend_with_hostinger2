<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Service Type</h2></x-slot>
    <div class="py-6">
        <div class="bg-white rounded-lg shadow p-6 max-w-md">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4"><label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ $service->name }}" required class="w-full border rounded px-3 py-2"></div>
                <div class="mb-4"><label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ $service->description }}</textarea></div>
                <div class="mb-4"><label class="block text-sm font-medium mb-1">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ $service->price }}" required class="w-full border rounded px-3 py-2"></div>
                <div class="mb-4"><label class="block text-sm font-medium mb-1">Duration (minutes)</label>
                    <input type="number" name="duration_minutes" value="{{ $service->duration_minutes }}" required class="w-full border rounded px-3 py-2"></div>
                <div class="mb-4"><label><input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}> Active</label></div>
                <div class="flex gap-4 justify-end mt-6">
                    <a href="{{ route('admin.services.index') }}" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-medium">Cancel</a>
                    <button type="submit" class="px-6 py-2 border-2 border-black bg-transparent hover:bg-black text-black hover:text-white rounded-lg transition font-semibold">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

