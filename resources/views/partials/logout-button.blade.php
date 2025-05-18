<form method="POST" action="{{ route('me.logout') }}">
    @csrf
    <button type="submit"
            class="inline-block bg-neutral-600 text-white dark:bg-neutral-500 dark:text-white font-semibold text-sm px-4 py-2 rounded-md transition hover:opacity-90">
        Log Out
    </button>
</form>
