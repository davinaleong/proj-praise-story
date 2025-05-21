<footer class="mt-4">
    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
        @include('partials.copyright')
    </p>
    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-2">
        <span><a href="{{ route('contact') }}" class="underline hover:text-gray-700 dark:hover:text-gray-300">Contact Us</a></span>
        <span>|</span>
        <span><a href="{{ route('terms-and-conditions.show') }}" class="underline hover:text-gray-700 dark:hover:text-gray-300">T&amp;C</a></span>
        <span>|</span>
        <span><a href="{{ route('privacy-policy.show') }}" class="underline hover:text-gray-700 dark:hover:text-gray-300">Privacy</a></span>
    </p>
</footer>
