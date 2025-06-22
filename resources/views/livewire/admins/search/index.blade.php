<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Search</h1>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    {{-- Search Bar --}}
    <input
        type="text"
        wire:model.live="query"
        placeholder="Search users, testimonies, messages..."
        class="w-full mb-10 px-4 py-3 border rounded-md text-sm shadow-sm border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-900 text-gray-800 dark:text-gray-100"
    />

    @if (strlen($query) >= 2)
        {{-- Users Table --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Users</h2>
            <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Registered At</th>
                            <th class="px-6 py-4 text-right">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $user->status ?? '—' }}</td>
                                <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 flex justify-end gap-2">
                                    <a href="{{ route('admins.users.show', $user->uuid) }}"
                                        class="text-gray-500 hover:text-black dark:hover:text-white" title="View User">
                                        @include('flux.icon.eye')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Testimonies Section --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Testimonies</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($testimonies as $t)
                    <li class="px-4 py-2 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded">
                        {{ $t->title }}
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">No testimonies found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Contact Messages Section --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Contact Messages</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($contacts as $c)
                    <li class="px-4 py-2 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded">
                        {{ $c->name }}: {{ Str::limit($c->message, 50) }}
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">No contact messages found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Feedback Messages Section --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Feedback</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($feedback as $f)
                    <li class="px-4 py-2 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded">
                        {{ Str::limit($f->message, 50) }}
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">No feedback found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Messages Section --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Messages</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($messages as $m)
                    <li class="px-4 py-2 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded">
                        {{ Str::limit($m->content, 50) }}
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">No messages found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Special Contents Section --}}
        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Special Contents</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($specials as $s)
                    <li class="px-4 py-2 bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-700 rounded">
                        {{ $s->title }}
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">No special content found.</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
