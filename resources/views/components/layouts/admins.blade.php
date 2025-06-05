<x-layouts.admins.header.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}

        @include('partials.footer-admin')
    </flux:main>
</x-layouts.admins.header.sidebar>
