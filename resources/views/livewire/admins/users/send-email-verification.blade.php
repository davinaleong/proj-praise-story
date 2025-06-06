<section class="w-full">
    @include('partials.admin-users-heading')

    <x-admins.users.layout
        :heading="$heading"
        :subheading="'Send a verification email if the user has not verified their email address.'">

        <div class="my-6 w-full space-y-6 text-sm text-gray-800 dark:text-gray-100">
            @if (! $user->hasVerifiedEmail())
                <p class="text-sm text-gray-600 dark:text-gray-300 my-2">
                    This will send a verification email to: <strong>{{ $user->email }}</strong>
                </p>

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button wire:click="sendVerificationEmail" variant="primary" type="button" class="w-full">
                            {{ __('Send Verification Link') }}
                        </flux:button>
                    </div>

                    <x-action-message class="me-3" on="verification-link-sent">
                        {{ $statusMessage }}
                    </x-action-message>
                </div>
            @else
                <p class="text-sm text-green-600 dark:text-green-400 my-2">
                    This user has already verified their email address.
                </p>
            @endif
        </div>
    </x-admins.users.layout>
</section>
