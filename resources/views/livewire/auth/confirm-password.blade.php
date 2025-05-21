<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Confirm password')"
        :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Confirm') }}</flux:button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <flux:link class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center" :href="route('home')" wire:navigate>
            &larr; {{ __('Back to Home') }}
        </flux:link>
    </div>

    @include('partials.footer')
</div>
