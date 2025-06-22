<?php

namespace App\Livewire\Testimonies;

use Livewire\Component;
use App\Models\Like;
use App\Models\Testimony;
use App\Helpers\Status;
use App\Enums\LikeType;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid)
    {
        $this->testimony = Testimony::with('likes')
            ->where('uuid', $uuid)
            ->where('status', Status::STATUS_TESTIMONY_PUBLIC)
            ->firstOr(fn () => abort(404));
    }

    public function like(string $type)
    {
        if (!in_array($type, array_column(LikeType::cases(), 'value'))) {
            abort(400, 'Invalid like type.');
        }

        Like::create([
            'testimony_id' => $this->testimony->id,
            'type' => $type,
        ]);

        $this->testimony->refresh(); // reload likes after storing

        return redirect()->route('testimonies.public', $this->testimony->uuid);
    }

    public function render()
    {
        return view('livewire.testimonies.show', [
            'shareUrl' => route('testimonies.public', $this->testimony->uuid),
        ])->layout('components.layouts.app', [
            'title' => $this->testimony->title,
        ]);
    }
}
