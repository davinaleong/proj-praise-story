<div class="grid h-screen w-full gap-6 p-6 grid-rows-[1fr_1fr]">
    {{-- Top Full-Width Card: Manage Testimonies --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <a href="{{ route('admin.users.index') }}"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Users') }}</h2>
        </a>

        <a href="#"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Testimonies') }}</h2>
        </a>
    </div>

    {{-- Bottom Row: Contact + Feedback --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <a href="#"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Contact Messages') }}</h2>
        </a>

        <a href="#"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Feedback Messages') }}</h2>
        </a>
    </div>
</div>
