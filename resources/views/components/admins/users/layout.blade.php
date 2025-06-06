@php
$user = session('user');
@endphp

<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('admins.users.show', ['uuid' => $user->uuid])" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
            <flux:navlist.item :href="route('admins.users.send-reset-link', ['uuid' => $user->uuid])" wire:navigate>{{ __('Password') }}</flux:navlist.item>
            <flux:navlist.item :href="route('admins.users.send-verification-link', ['uuid' => $user->uuid])" wire:navigate>{{ __('Verification') }}</flux:navlist.item>
            <flux:navlist.item :href="route('admins.users.testimonies.index', ['uuid' => $user->uuid])" wire:navigate>{{ __('Testimonies') }}</flux:navlist.item>
            {{-- <flux:navlist.item :href="route('admins.users.status', ['uuid' => $user->uuid])" wire:navigate>{{ __('Status') }}</flux:navlist.item> --}}
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
