<section class="w-full">
    @include('partials.admin-users-heading')

    <x-admins.users.layout :heading="$heading" :subheading="$subheading">
        <div class="my-6 w-full space-y-6 text-sm text-gray-800 dark:text-gray-100">
            <p class="text-sm text-gray-600 dark:text-gray-300 my-2">
                This will send a reset password link to: <strong>{{ $user->email }}</strong>
            </p>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button wire:click="sendResetLink" variant="primary" type="button" class="w-full">
                        {{ __('Send Reset Link') }}
                    </flux:button>
                </div>

                @if ($statusMessage)
                    <x-action-message class="me-3" on="reset-link-sent">
                        {{ $statusMessage }}
                    </x-action-message>
                @endif
            </div>
        </div>
    </x-admins.users.layout>
</section>
