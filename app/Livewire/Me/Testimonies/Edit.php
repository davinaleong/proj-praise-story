<?php

namespace App\Http\Livewire\Me\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public Testimony $testimony;

    public $title;
    public $content;
    public $status;
    public $published_at;
    public array $statuses = [];

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::where('uuid', $uuid)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->fill([
            'title' => $this->testimony->title,
            'content' => $this->testimony->content,
            'status' => $this->testimony->status,
            'published_at' => $this->testimony->published_at->format('Y-m-d'),
            'statuses' => Status::getSelectOptions(),
        ]);
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string',
            'published_at' => 'required|date',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->testimony->update([
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ]);

        session()->flash('success', 'Testimony updated successfully.');

        return redirect()->route('me.testimonies.show', $this->testimony->uuid);
    }

    public function render()
    {
        return view('livewire.me.testimonies.edit')
            ->layout('layouts.app', ['title' => 'Edit Testimony']);
    }
}
