@php use Illuminate\Support\Str; @endphp

<x-layouts.app :title="$testimony->title">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Back Link --}}
        <header class="mb-6">
            <a href="{{ route('home') }}"
               class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center">
                &larr; Back to Praise Stories
            </a>
        </header>

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
            {{ $testimony->title }}
        </h1>

        {{-- Author & Date --}}
        <p class="text-sm text-gray-500 dark:text-gray-400 italic mb-6">
            Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
        </p>

        {{-- Content --}}
        <article class="prose dark:prose-invert max-w-none">
            {!! Str::markdown($testimony->content) !!}
        </article>

        @include('partials.copyright')
    </div>
</x-layouts.app>
