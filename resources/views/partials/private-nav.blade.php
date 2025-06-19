<div class="flex items-center gap-3">
    <a href="{{ route('private.testimonies.index') }}"
        class="inline-block bg-black text-white dark:bg-white dark:text-black font-semibold text-sm px-4 py-2 rounded-md transition hover:opacity-90">
        Private Testimonies
    </a>
    <a href="{{ route('special-content.index') }}"
    class="inline-block bg-blue-600 text-white font-semibold text-sm px-4 py-2 rounded-md transition hover:bg-blue-700">
        Special Content
    </a>
    <a href="{{ route('me.dashboard') }}"
        class="inline-block bg-gray-900 text-white dark:bg-gray-100 dark:text-black font-semibold text-sm px-4 py-2 rounded-md transition hover:opacity-90">
        Dashboard
    </a>
    <form method="POST" action="{{ route('me.logout') }}">
        @csrf
        <button type="submit"
                class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Log Out
        </button>
    </form>
</div>
