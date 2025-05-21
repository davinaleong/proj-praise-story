<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gray-100 dark:bg-zinc-900">
    <div class="max-w-md w-full space-y-6 bg-white dark:bg-zinc-800 p-8 rounded-xl shadow-lg">
        <h1 class="text-center text-2xl font-bold text-gray-900 dark:text-white">
            Go Premium · S$10.90/month
        </h1>

        <p class="text-sm text-center text-gray-600 dark:text-gray-400">
            Premium users can create and manage private testimonies with full control over visibility.
        </p>

        @if (session('message'))
            <div class="text-green-600 text-center font-medium">
                {{ session('message') }}
            </div>
        @endif

        <button wire:click="pay"
            class="w-full bg-black text-white dark:bg-white dark:text-black px-4 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            Pay with Card
        </button>

        <div class="text-sm text-center text-gray-500 dark:text-gray-400">
            Already a member? <a href="{{ route('me.login') }}" class="underline">Login here</a>
        </div>

        @include('partials.footer')
    </div>
</div>
