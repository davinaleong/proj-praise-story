@php use Illuminate\Support\Str; @endphp

<h1>Testimonies</h1>

<h2>{{ $testimony->title }}</h2>

<h3>Details</h3>

<nav>
    <a href="{{ route('testimonies.index') }}">Back</a> |
    <a href="{{ route('testimonies.edit', $testimony->uuid) }}">Edit</a> |
    <form action="{{ route('testimonies.destroy', $testimony->uuid) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>
    </form>
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
            <th>Publisehd At:</th>
            <td>{{ $testimony->getHumanPublishedAt() }}</td>
        </tr>
    </tbody>
</table>
