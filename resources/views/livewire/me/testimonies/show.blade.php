@php use Illuminate\Support\Str; @endphp

@php
    $backRoute = $from === 'public'
        ? route('me.public.index')
        : route('me.testimonies.index');
@endphp

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Back Link --}}
    <div class="mb-6">
        <a href="{{ $backRoute }}"
            class="text-sm text-gray-600 dark:text-gray-400 hover:underline flex items-center">
            &larr; Back
        </a>
    </div>

    {{-- Title --}}
    {{-- Title + Edit --}}
    <header class="flex items-center justify-between mb-2">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $testimony->title }}
        </h1>

        <a href="{{ route('me.testimonies.edit', $testimony->uuid) }}"
        class="inline-flex gap-2 items-center text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md transition">
            @include('flux.icon.pencil') Edit
        </a>
    </header>


    {{-- Author & Date --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 italic mb-6">
        Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
    </p>

    {{-- Content --}}
    <article class="prose dark:prose-invert max-w-none">
        {!! Str::markdown($testimony->content) !!}
    </article>

    {{-- Delete Button --}}
    <div class="flex justify-end">
        <form wire:submit.prevent="delete">
            <button type="submit"
                    onclick="return confirm('Are you sure you want to delete this testimony?')"
                    class="text-sm flex gap-2 align-items px-4 py-2 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition">
                @include('flux.icon.trash') Delete
            </button>
        </form>
    </div>
</div>
