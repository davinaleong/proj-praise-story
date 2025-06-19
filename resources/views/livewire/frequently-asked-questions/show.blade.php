<div class="prose dark:prose-invert mx-auto max-w-4xl py-12 px-4">
    @include('livewire.frequently-asked-questions.content')

    {{-- Optional back button --}}
    <div class="mt-8">
        <a href="{{ url('/') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline hover:text-black dark:hover:text-white">
            ← Back
        </a>
    </div>

    @include('partials.footer')
</div>
