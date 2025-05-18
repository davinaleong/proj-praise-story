@php use Illuminate\Support\Str; @endphp

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Back Link --}}
    <div class="mb-6">
        <a href="{{ route('me.published.index') }}"
            class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center">
            &larr; Back to My Published Testimonies
        </a>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
        {{ $testimony->title }}
    </h1>

    {{-- Author & Date --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 italic mb-6">
        Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
    </p>

    {{-- Content --}}
    <div class="prose dark:prose-invert max-w-none">
        {!! Str::markdown($testimony->content) !!}
    </div>
</div>
