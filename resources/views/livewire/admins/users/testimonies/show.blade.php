@php use Illuminate\Support\Str; @endphp

<section class="w-full">
    @include('partials.admin-users-heading')

    <x-admins.users.layout :heading="$heading" :subheading="$subheading">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Title --}}
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                {{ $testimony->title }}
            </h1>

            {{-- Author & Date --}}
            <p class="text-sm text-gray-500 dark:text-gray-400 italic mb-6">
                Written by {{ optional($user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}
            </p>

            {{-- Content --}}
            <article class="prose dark:prose-invert max-w-none">
                {!! Str::markdown($testimony->content) !!}
            </article>
        </div>
    </x-admins.users.layout>
</section>
