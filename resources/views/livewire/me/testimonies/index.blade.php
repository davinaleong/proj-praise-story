<x-layouts.app title="My Testimonies">
    <h1>Testimonies</h1>

    <h2>List Testimony</h2>

    <nav class="mb-4">
        <a href="{{ route('me.testimonies.create') }}">Create a testimony</a>
    </nav>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Published At</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonies as $testimony)
                <tr>
                    <td class="border px-4 py-2">{{ $testimony->title }}</td>
                    <td class="border px-4 py-2">{{ $testimony->getHumanPublishedAt() }}</td>
                    <td class="border px-4 py-2">{{ $testimony->getHumanStatus() }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('me.testimonies.show', $testimony->uuid) }}">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">
                        <em>No testimony entries.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if ($testimonies->hasPages())
        <tfoot>
            <tr>
                <td colspan="4" class="px-4 py-2">
                    {{ $testimonies->links() }}
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</x-layouts.app>
