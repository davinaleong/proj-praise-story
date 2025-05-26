<div class="grid h-screen w-full gap-6 p-6 grid-rows-[2fr_1fr]">
    {{-- Top Full-Width Card: Manage Testimonies --}}
    <a href="#"
       class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
              dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
        <h2 class="text-2xl font-semibold">{{ __('Manage Testimonies') }}</h2>
        <p class="text-4xl font-bold mt-2">{{ $testimonyCount }}</p>
    </a>

    {{-- Bottom Row: Contact + Feedback --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <a href="#"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Contact Messages') }}</h2>
            <p class="text-3xl font-bold mt-2">{{ $contactCount }}</p>
        </a>

        <a href="#"
           class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                  dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
            <h2 class="text-lg font-semibold">{{ __('Manage Feedback Messages') }}</h2>
            <p class="text-3xl font-bold mt-2">{{ $feedbackCount }}</p>
        </a>
    </div>
</div>
