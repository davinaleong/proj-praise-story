<?php

namespace App\Http\Livewire\Me\Testimonies;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // if using Tailwind pagination

    public function render()
    {
        $testimonies = Testimony::where('user_id', Auth::id())
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.me.testimonies.index', compact('testimonies'))
            ->layout('layouts.app', ['title' => 'My Testimonies']);
    }
}
