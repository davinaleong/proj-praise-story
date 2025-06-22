@php use Illuminate\Support\Str; @endphp

<x-layouts.app :title="$testimony->title">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Back Link --}}
        <header class="mb-6">
            @include('partials.likes-bar')

            <a href="{{ route('home') }}"
                class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center">
                &larr; Back to Praise Stories
            </a>

            <div class="flex justify-between gap-4">
                {{-- Title --}}
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ $testimony->title }}
                </h1>

                @include('partials.like-buttons')
            </div>

            {{-- Author & Date --}}
            <p class="text-sm text-gray-500 dark:text-gray-400 italic mb-6">
                Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
            </p>
        </header>

        {{-- Content --}}
        <article class="prose dark:prose-invert max-w-none">
            {!! Str::markdown($testimony->content) !!}
        </article>

        <section class="flex flex-wrap gap-4 mt-6">
            <span class="font-medium">Share this testimony:</span>

            {{-- WhatsApp --}}
            <a href="https://wa.me/?text={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
            class="text-green-600 hover:underline">WhatsApp</a>

            {{-- Telegram --}}
            <a href="https://t.me/share/url?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
            class="text-blue-500 hover:underline">Telegram</a>

            {{-- Facebook --}}
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
            class="text-blue-700 hover:underline">Facebook</a>

            {{-- X / Twitter --}}
            <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
            class="text-gray-700 hover:underline">X</a>

            {{-- Copy Link Button --}}
            <button onclick="navigator.clipboard.writeText('{{ $shareUrl }}'); alert('Link copied!')"
                    class="text-indigo-600 hover:underline">Copy Link</button>
        </section>


        @include('partials.footer')
    </div>
</x-layouts.app>
