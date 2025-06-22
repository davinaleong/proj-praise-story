<?php

namespace App\Livewire\Private\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;
use App\Enums\LikeType;
use App\Models\Like;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')
            ->where('uuid', $uuid)
            ->whereIn('status', [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE])
            ->firstOrFail();
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

        return redirect()->route('private.testimonies.index', $this->testimony->uuid);
    }

    public function render()
    {
        return view('livewire.private.testimonies.show')
            ->layout('components.layouts.app', [
                'title' => $this->testimony->title,
            ]);
    }
}
