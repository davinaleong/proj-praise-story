<h1>Premium Praise Stories</h1>

<div>
    @foreach($testimonies as $testimony)
    <div>
        <h2>{{ $testimony->title }}</h2>
        <p><em>{{ $testimony->getHumanPublishedAt() }}</em></p>

        <p>
            <a href="{{ route('private.show', $testimony->uuid) }}">
                Read more &hellip;
            </a>
        </p>
        <hr>
    </div>
    @endforeach
</div>
