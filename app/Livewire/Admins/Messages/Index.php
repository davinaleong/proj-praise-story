<?php

namespace App\Livewire\Admins\Messages;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $messages = Message::paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.messages.index', [
            'messages' => $messages,
        ])->layout('components.layouts.admin', [
            'title' => 'Messages',
        ]);
    }
}
