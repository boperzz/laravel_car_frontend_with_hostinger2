<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800"><i class="fas fa-wrench mr-2"></i>Service Types</h2>
            <a href="{{ route('admin.services.create') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Service
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($services as $service)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($service->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->duration_minutes }} min</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.services.edit', $service) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-4 text-center">No services.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4">{{ $services->links() }}</div>
        </div>
    </div>
</x-app-layout>

