<div class="space-y-4">
    <table class="w-full border border-gray-200 rounded shadow-sm text-sm">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-2">Title</th>
                <th class="p-2">Slug</th>
                <th class="p-2">Status</th>
                <th class="p-2">Sort</th>
                <th class="p-2">Created At</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groups as $group)
                <tr class="border-t">
                    <td class="p-2">{{ $group->title }}</td>
                    <td class="p-2 text-gray-500">{{ $group->slug }}</td>
                    <td class="p-2">{{ ucfirst($group->status) }}</td>
                    <td class="p-2 text-center">{{ $group->sort_order }}</td>
                    <td class="p-2 text-gray-500">{{ $group->created_at->format('d-m-Y') }}</td>
                    <td class="p-2">
                        <a href="#" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">No content groups found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $groups->links() }}
    </div>
</div>
