<div class="flex min-h-screen flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <!-- Logo -->
            <div class="grid place-items-center">
                <x-app-logo-icon class="mx-auto h-10 w-auto" />
            </div>
            <div class="ms-1 grid flex-1 text-center text-sm">
                <span class="mb-0.5 truncate leading-none font-semibold">Praise Story</span>
            </div>

            <h2 class="mt-6 text-2xl font-bold text-gray-900 dark:text-white">
                Subscribe to Premium
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                S$10 for private testimonies and bonus content
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white dark:bg-zinc-900 py-8 px-6 shadow rounded-lg sm:px-10">
            <form wire:submit.prevent="pay" class="space-y-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black dark:bg-white dark:text-black hover:bg-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Pay S$10
                </button>
            </form>
        </div>
    </div>

    <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
        <a href="{{ route('home') }}" class="text-black dark:text-white underline">
            ← Back to Home
        </a>
    </div>

    @include('partials.footer')
</div>
