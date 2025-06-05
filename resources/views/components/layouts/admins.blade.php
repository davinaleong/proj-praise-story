<x-layouts.admins.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}

        @include('partials.footer-admin')
    </flux:main>
</x-layouts.admins.sidebar>
