<h1>Testimonies</h1>

<h2>Create a Testimony</h2>

<p>
    <a href="{{ route('testimonies.index') }}">Back</a>
</p>

<form action="{{ route('testimonies.store') }}" method="post">
    @csrf

    <div>
        <label for="input-title">Title*</label>
        <input type="text" name="title" id="input-title" required />
    </div>

    <div>
        <label for="input-content">Content*</label>
        <textarea name="content" id="input-content" rows="10" required></textarea>
    </div>

    <div>
        <label for="input-status">Status*</label>
        <select name="status" id="input-status" required>
            @foreach($statuses as $key=>$value)
                <option value="{{ $key }}" {{ $key === 'draft' ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="input-published_at">Published At*</label>
        <input type="date" name="published_at" id="input-published_at" required />
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
