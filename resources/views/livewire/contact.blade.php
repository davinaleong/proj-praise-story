<div class="h-screen flex items-center justify-center px-4">
    <div class="max-w-[60ch] w-full flex flex-col justify-center gap-6">
        <x-auth-header
            :title="__('Contact Us')"
            :description="__('Send us a message and we’ll get back to you shortly')"
        />

        <!-- Session Message -->
        @if (session()->has('success'))
            <div class="text-center text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="flex flex-col gap-6">
            <!-- Honeypot Field -->
            <input type="text" wire:model="honeypot" name="company" class="hidden" tabindex="-1" autocomplete="off">

            <!-- Email Address -->
            <flux:input
                wire:model.defer="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Message -->
            <flux:textarea
                wire:model.defer="message"
                :label="__('Message')"
                required
                rows="6"
                placeholder="Type your message here"
            />

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-4">
                <flux:link class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center" :href="route('home')" wire:navigate>
                    &larr; {{ __('Back to Home') }}
                </flux:link>

                <flux:button variant="primary" type="submit">
                    {{ __('Send Message') }}
                </flux:button>
            </div>
        </form>

        @include('partials.footer')
    </div>
</div>
