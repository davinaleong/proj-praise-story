<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Subscribe to Premium')" :description="__('S$10 for private testimonies and bonus content')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit.prevent="pay" class="space-y-6">
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black dark:bg-white dark:text-black hover:bg-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
            Pay S$10
        </button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <flux:link class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center" :href="route('home')" wire:navigate>
            &larr; {{ __('Back to Home') }}
        </flux:link>
    </div>

    @include('partials.footer')
</div>
