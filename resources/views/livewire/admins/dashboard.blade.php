<div class="w-full">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="grid h-screen gap-6 p-6 grid-rows-[1fr_1fr]">
        {{-- Top Full-Width Card: Manage Testimonies --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <a href="{{ route('admins.users.index') }}"
            class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                    dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                <h2 class="text-lg font-semibold">{{ __('Manage Users') }}</h2>
            </a>

            <a href="{{ route('admins.testimonies.index') }}"
            class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                    dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                <h2 class="text-lg font-semibold">{{ __('Manage Testimonies') }}</h2>
            </a>
        </div>

        {{-- Bottom Row: Contact + Feedback --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <a href="{{ route('admins.contact-messages.index') }}"
            class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                    dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                <h2 class="text-lg font-semibold">{{ __('Manage Contact Messages') }}</h2>
            </a>

            <a href="{{ route('admins.feedback-messages.index') }}"
            class="flex flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white text-center shadow hover:bg-neutral-50
                    dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                <h2 class="text-lg font-semibold">{{ __('Manage Feedback Messages') }}</h2>
            </a>
        </div>
    </div>
</div>
