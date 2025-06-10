<?php

namespace App\Livewire\Me\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;
use App\Rules\NoProfanity;

class Create extends Component
{
    public $title;
    public $content;
    public $status;
    public $published_at;
    public array $statuses = [];
    public string $from = 'testimonies'; // default

    public function mount()
    {
        $this->status = Status::STATUS_TESTIMONY_DRAFT;
        $this->statuses = Status::getTestimonySelectOptions();
        $this->from = request()->query('from', 'testimonies');
    }

    protected function rules(): array
    {
        $statuses = implode(',', Status::STATUSES_TESTIMONY);

        return [
            'title' => ['required', 'string', 'max:255', new NoProfanity],
            'content' => ['required', 'string', new NoProfanity],
            'status' => ['required', 'string', "in:$statuses"],
            'published_at' => ['required', 'date'],
        ];
    }

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
