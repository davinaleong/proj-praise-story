@php use Illuminate\Support\Str; @endphp

<x-layouts.app :title="$testimony->title">
    <h1>Testimonies</h1>

    <h2>{{ $testimony->title }}</h2>

    <h3>Details</h3>

    <nav class="mb-4">
        <a href="{{ route('me.testimonies.index') }}">Back</a> |
        <a href="{{ route('me.testimonies.edit', $testimony->uuid) }}">Edit</a> |
        <button wire:click="delete" onclick="return confirm('Are you sure you want to delete this testimony?')">
            Delete
        </button>
    </nav>

    <div>
        {!! Str::markdown($testimony->content) !!}
    </div>

    <table>
        <tbody>
            <tr>
                <th>Author:</th>
                <td>{{ $testimony->user->name }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ $testimony->getHumanStatus() }}</td>
            </tr>
            <tr>
                <th>Published At:</th>
                <td>{{ $testimony->getHumanPublishedAt() }}</td>
            </tr>
        </tbody>
    </table>
</x-layouts.app>
