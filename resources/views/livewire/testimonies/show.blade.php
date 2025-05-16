@php use Illuminate\Support\Str; @endphp

<h1>Praise Stories</h1>

<nav>
    <a href="{{ route('testimonies.index') }}">Back</a>
</nav>

<h2>{{ $testimony->title }}</h2>

<p><em>Written by {{ $testimony->user->name }} on {{ $testimony->getHumanPublishedAt() }}</em></p>

<div>
    {!! Str::markdown($testimony->content) !!}
</div>
