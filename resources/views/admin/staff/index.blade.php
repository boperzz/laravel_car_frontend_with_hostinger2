<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800"><i class="fas fa-users mr-2"></i>Staff Management</h2>
            <a href="{{ route('admin.staff.create') }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-4 py-2 rounded-lg transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Staff
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($staff as $member)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.staff.edit', $member) }}" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="border-2 border-black bg-transparent hover:bg-black text-black hover:text-white px-3 py-1 rounded transition text-sm font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-4 text-center">No staff members.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4">{{ $staff->links() }}</div>
        </div>
    </div>
</x-app-layout>

