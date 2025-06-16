<div class="w-full">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Special Content</h1>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="grid gap-6 p-6 grid-cols-1 md:grid-cols-2 h-150">
        {{-- Manage Groups --}}
        <a href="{{ route('admins.special-contents.groups.index') }}"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Groups') }}</h2>
        </a>

        {{-- Manage Items --}}
        <a href="{{ route('admins.special-contents.items.index') }}"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Items') }}</h2>
        </a>
    </div>
</div>
