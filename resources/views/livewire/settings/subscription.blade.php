<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Subscription')" :subheading="__('Manage your premium subscription')">
        <div class="my-6 w-full space-y-6">
            @if ($subscription && $subscription->status === 'active')
                <div class="rounded-lg border border-green-400 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 p-4">
                    <p class="font-semibold">{{ __('You are subscribed to Premium.') }}</p>
                    <p class="text-sm mt-1">
                        {{ __('Started on') }} {{ $subscription->started_at->format('d M Y') }}
                    </p>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('premium.cancel') }}" class="w-full">
                        <flux:button variant="danger" class="w-full">
                            {{ __('Cancel Subscription') }}
                        </flux:button>
                    </a>
                </div>
            @else
                <div class="rounded-lg border border-zinc-300 bg-zinc-100 dark:bg-zinc-800 p-4 text-zinc-700 dark:text-zinc-200">
                    <p>{{ __('You are not subscribed to Premium.') }}</p>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <flux:button wire:click="subscribe" variant="primary" class="w-full">
                        {{ __('Go Premium (S$10/month)') }}
                    </flux:button>
                </div>
            @endif
        </div>
    </x-settings.layout>
</section>
