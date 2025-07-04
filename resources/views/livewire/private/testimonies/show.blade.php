@php
    use Illuminate\Support\Str;
    use App\Helpers\Status;

    $isPrivate = $testimony->status === Status::STATUS_TESTIMONY_PRIVATE;
@endphp

<x-layouts.app :title="$testimony->title">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12
        {{ $isPrivate ? 'bg-black text-white dark:bg-white dark:text-black rounded-xl p-8' : '' }}">

        {{-- Back Link --}}
        <header class="mb-6">
            @include('partials.likes-bar')

            <a href="{{ route('private.testimonies.index') }}"
               class="text-sm underline hover:opacity-80
               {{ $isPrivate ? 'text-white dark:text-black' : 'text-gray-600 dark:text-gray-400' }}">
                &larr; Back to Private Praise Stories
            </a>

            <div class="flex justify-between gap-4">
                {{-- Title --}}
                <h1 class="text-3xl font-bold mb-2
                    {{ $isPrivate ? 'text-white dark:text-black' : 'text-gray-900 dark:text-white' }}">
                    {{ $testimony->title }}
                </h1>

                @include('partials.like-buttons')
            </div>

            {{-- Author & Date --}}
            <p class="text-sm italic mb-6
                {{ $isPrivate ? 'text-white/70 dark:text-black/70' : 'text-gray-500 dark:text-gray-400' }}">
                Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
            </p>
        </header>

        {{-- Content --}}
        <article class="prose dark:prose-invert max-w-none
            {{ $isPrivate ? 'prose-invert dark:prose' : '' }}">
            {!! Str::markdown($testimony->content) !!}
        </article>

        @include('partials.footer')
    </div>
</x-layouts.app>
