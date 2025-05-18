<?php

namespace App\Livewire\Me\Testimonies;

use Livewire\Component;
use App\Models\Testimony;

class Create extends Component
{
    public $title;
    public $content;
    public $status = 'draft';
    public $published_at;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|string',
        'published_at' => 'required|date',
    ];

    public function submit()
    {
        $this->validate();

        Testimony::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ]);

        return redirect()->route('me.testimonies.index');
    }

    public function render()
    {
        return view('livewire.me.testimonies.create')
            ->layout('components.layouts.me', ['title' => 'Create Testimony']);
    }
}
