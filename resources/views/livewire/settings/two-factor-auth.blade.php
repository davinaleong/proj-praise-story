<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Two-Factor Authentication')" :subheading="__('Add an extra layer of security to your account.')">
        <div class="my-6 w-full space-y-6">

            @if ($user->two_factor_secret)
                <div class="space-y-4">
                    <flux:text>
                        {{ __('Two-Factor Authentication is currently enabled on your account.') }}
                    </flux:text>

                    <div class="rounded bg-white dark:bg-neutral-800 p-4 border border-neutral-300 dark:border-neutral-700">
                        <div class="mb-2 font-semibold text-sm">
                            {{ __('Scan the QR code with your authenticator app:') }}
                        </div>

                        <div class="mt-2">
                            {!! $user->twoFactorQrCodeSvg() !!}
                        </div>

                        <flux:text class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            {{ __('Use Google Authenticator, Microsoft Authenticator, or any TOTP-compatible app.') }}
                        </flux:text>
                    </div>

                    @if ($recoveryCodes)
                        <div class="rounded bg-white dark:bg-neutral-800 p-4 border border-neutral-300 dark:border-neutral-700 space-y-3">
                            <div class="font-semibold text-sm">
                                {{ __('Recovery Codes') }}
                            </div>

                            <ul class="text-xs bg-neutral-100 dark:bg-neutral-900 p-3 rounded space-y-1 font-mono">
                                @foreach ($recoveryCodes as $code)
                                    <li>{{ $code }}</li>
                                @endforeach
                            </ul>

                            <div class="flex items-center gap-4">
                                <flux:button wire:click="regenerateRecoveryCodes">
                                    {{ __('Regenerate Recovery Codes') }}
                                </flux:button>

                                <x-action-message on="recovery-codes-regenerated">
                                    {{ __('Recovery codes regenerated.') }}
                                </x-action-message>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center gap-4">
                        <flux:button wire:click="disable" variant="danger" class="w-full">
                            {{ __('Disable 2FA') }}
                        </flux:button>

                        <x-action-message on="2fa-disabled">
                            {{ __('Two-Factor Authentication disabled.') }}
                        </x-action-message>
                    </div>
                </div>
            @else
                <flux:text>
                    {{ __('Two-Factor Authentication is currently disabled.') }}
                </flux:text>

                <div class="flex items-center gap-4">
                    <flux:button wire:click="enable" variant="primary" class="w-full">
                        {{ __('Enable 2FA') }}
                    </flux:button>

                    <x-action-message on="2fa-enabled">
                        {{ __('Two-Factor Authentication enabled.') }}
                    </x-action-message>
                </div>
            @endif

        </div>
    </x-settings.layout>
</section>
