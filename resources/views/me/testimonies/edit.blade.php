<h1>Testimonies</h1>

<h2>Edit: {{ $testimony->title }}</h2>

<nav>
    <a href="{{ route('me.testimonies.show', $testimony->uuid) }}">Back</a>
</nav>

<form action="{{ route('me.testimonies.update', $testimony->uuid) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="input-title">Title*</label>
        <input type="text" name="title" id="input-title" value="{{ old('title', $testimony->title) }}" required />
    </div>

    <div>
        <label for="input-content">Content*</label>
        <textarea name="content" id="input-content" rows="10" required>{{ old('content', $testimony->content) }}</textarea>
    </div>

    <div>
        <label for="input-status">Status*</label>
        <select name="status" id="input-status" required>
            @foreach($statuses as $key=>$value)
                <option value="{{ $key }}" {{ $key === old('status', $testimony->status) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="input-published_at">Published At*</label>
        <input type="date" name="published_at" id="input-published_at" value="{{ old('published_at', $testimony->getInputPublishedAt()) }}" required />
    </div>

    @if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div>
        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </div>
</form>
