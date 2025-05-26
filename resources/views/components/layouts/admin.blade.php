<x-layouts.admin.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}

        @include('partials.footer-me')
    </flux:main>
</x-layouts.admin.sidebar>
