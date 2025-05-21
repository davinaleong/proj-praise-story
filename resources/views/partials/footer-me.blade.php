<footer class="mt-4 mb-4">
    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
        @include('partials.copyright')
    </p>
    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-2">
        <span><a href="{{ route('me.terms-and-conditions') }}" class="underline hover:text-gray-700 dark:hover:text-gray-300">T&amp;C</a></span>
        <span>|</span>
        <span><a href="{{ route('me.privacy-policy') }}" class="underline hover:text-gray-700 dark:hover:text-gray-300">Privacy</a></span>
    </p>
</footer>
