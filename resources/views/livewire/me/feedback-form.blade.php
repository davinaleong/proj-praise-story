<div class="h-screen flex items-center justify-center px-4">
    <div class="max-w-[60ch] w-full flex flex-col justify-center gap-6">
        <x-auth-header
            :title="__('Feedback')"
            :description="__('Let us know how we’re doing or how we can improve')"
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

            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Rating') }}
                </label>
                <div class="flex gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                                fill="{{ $rating >= $i ? 'currentColor' : 'none' }}"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.123 6.533h6.87c.969 0 1.371 1.24.588 1.81l-5.553 4.033 2.122 6.533c.3.921-.755 1.688-1.538 1.118L12 18.902l-5.553 4.033c-.783.57-1.838-.197-1.538-1.118l2.122-6.533-5.553-4.033c-.783-.57-.38-1.81.588-1.81h6.87l2.123-6.533z"/>
                            </svg>
                        </button>
                    @endfor
                </div>
                @error('rating')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            @error('rating')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

            <!-- Message -->
            <flux:textarea
                wire:model.defer="message"
                :label="__('Message')"
                rows="6"
                placeholder="Type your feedback here"
            />
            @error('message')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

            <!-- Submit Button + Back -->
            <div class="flex items-center justify-end gap-4">
                <flux:button variant="primary" type="submit">
                    {{ __('Submit Feedback') }}
                </flux:button>
            </div>
        </form>

        @include('partials.footer')
    </div>
</div>
