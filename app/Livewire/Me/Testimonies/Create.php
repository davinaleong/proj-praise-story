<?php

namespace App\Livewire\Me\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;

class Create extends Component
{
    public $title = '';
    public $content = '';
    public $status = 'draft';
    public $published_at = '';
    public array $statuses = [];
    public string $from = 'testimonies'; // default

    public function mount()
    {
        $this->statuses = Status::getSelectOptions();
        $this->from = request()->query('from', 'testimonies');
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|string|in:public,private,published,draft',
        'published_at' => 'required|date',
    ];

    public function submit()
    {
        $this->validate();

        $testimony = Testimony::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ]);

        return redirect()
            ->route('me.testimonies.show', $testimony->uuid);
    }

    public function render()
    {
        return view('livewire.me.testimonies.create')
            ->layout('components.layouts.me', ['title' => 'Create Testimony']);
    }
}
