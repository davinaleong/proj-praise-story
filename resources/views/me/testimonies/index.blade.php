<h1>Testimonies</h1>

<h2>List Testimony</h2>

<nav>
    <a href="{{ route('me.testimonies.create') }}">Create a testimony</a>
</nav>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Published At</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($testimonies as $testimony)
            <tr>
                <td>{{ $testimony->title }}</td>
                <td>{{ $testimony->getHumanPublishedAt() }}</td>
                <td>{{ $testimony->getHumanStatus() }}</td>
                <td>
                    <a href="{{ route('me.testimonies.show', $testimony->uuid) }}">View</a>
                </td>
            </tr>
        @empty
        <tr>
            <td colspan="3">
                <em>No testimony entries.</em>
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        {{ $testimonies->links() }}
    </tfoot>
</table>
