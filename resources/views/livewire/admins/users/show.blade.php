<section class="w-full">
    @include('partials.admin-users-heading')

    <x-admins.users.layout :heading="$heading" :subheading="$subheading">
        <div class="my-6 w-full space-y-6 text-sm text-gray-800 dark:text-gray-100">
            <div>
                <label class="block font-semibold mb-1">UUID</label>
                <div class="rounded border border-gray-300 dark:border-gray-700 px-3 py-2 bg-gray-100 dark:bg-zinc-800">
                    {{ $user->uuid }}
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-1">Name</label>
                <div class="rounded border border-gray-300 dark:border-gray-700 px-3 py-2 bg-gray-100 dark:bg-zinc-800">
                    {{ $user->name }}
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <div class="rounded border border-gray-300 dark:border-gray-700 px-3 py-2 bg-gray-100 dark:bg-zinc-800">
                    {{ $user->email }}
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-1">Email Verified At</label>
                <div class="rounded border border-gray-300 dark:border-gray-700 px-3 py-2 bg-gray-100 dark:bg-zinc-800">
                    {{ $user->email_verified_at?->format('d-m-Y H:i') ?? 'Not Verified' }}
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-1">Registered On</label>
                <div class="rounded border border-gray-300 dark:border-gray-700 px-3 py-2 bg-gray-100 dark:bg-zinc-800">
                    {{ $user->created_at?->format('d-m-Y H:i') ?? '—' }}
                </div>
            </div>
        </div>
    </x-admins.users.layout>
</section>
