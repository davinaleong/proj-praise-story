<h1>Testimonies</h1>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Published Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($testimonies as $testimony)
            <tr>
                <td>{{ $testimony->title }}</td>
                <td>{{ $testimony->getHumanPublishedDate() }}</td>
                <td>{{ $testimony->getHumanStatus() }}</td>
                <td></td>
            </tr>
        @else
        <tr>
            <td colspan="3">
                <em>No testimony entries.</em>
            </td>
        </tr>
    </tbody>
    <tfoot>
        {{ $testimonies->links() }}
    </tfoot>
</table>
