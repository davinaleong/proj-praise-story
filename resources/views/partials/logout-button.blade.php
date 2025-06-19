<form method="POST" action="{{ route('me.logout') }}">
    @csrf
    <button type="submit"
            class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
        Log Out
    </button>
</form>
