<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Two-Factor Authentication')"
        :description="__('Enter the 6-digit code from your authenticator app or a recovery code.')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit.prevent="authenticate" class="flex flex-col gap-6">
        <!-- Authentication Code -->
        <flux:input
            wire:model.defer="code"
            :label="__('Authentication Code')"
            type="text"
            inputmode="numeric"
            autofocus
            autocomplete="one-time-code"
            placeholder="123456"
        />

        <!-- Divider -->
        <div class="text-sm text-center text-zinc-600 dark:text-zinc-400">
            {{ __('OR') }}
        </div>

        <!-- Recovery Code -->
        <flux:input
            wire:model.defer="recovery_code"
            :label="__('Recovery Code')"
            type="text"
            autocomplete="one-time-code"
            placeholder="xxxx-xxxx"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">
                {{ __('Verify & Log in') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <flux:link
            class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center"
            :href="route('login')"
            wire:navigate
        >
            &larr; {{ __('Back to Login') }}
        </flux:link>
    </div>

    @include('partials.footer-admin')
</div>
