<x-layouts.me.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}

        @include('partials.copyright')
        <div class="mb-4">&nbsp;</div>
    </flux:main>
</x-layouts.me.sidebar>
