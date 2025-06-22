<?php

namespace App\Livewire\Admins\Search;

use Livewire\Component;
use App\Models\User;
use App\Models\Testimony;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\SpecialContentItem;

class Index extends Component
{
    public string $query = '';

    public function render()
    {
        // dd($this->query);
        $users = $testimonies = $contacts = $feedback = $messages = $specials = collect();

        if (strlen($this->query) >= 2) {
            $users = User::where('name', 'like', "%{$this->query}%")
                ->orWhere('email', 'like', "%{$this->query}%")
                ->limit(5)->get();

            $testimonies = Testimony::where('title', 'like', "%{$this->query}%")
                ->limit(5)->get();

            $contacts = Contact::where('subject', 'like', "%{$this->query}%")
                ->orWhere('email', 'like', "%{$this->query}%")
                ->limit(5)->get();

            $feedback = Feedback::where('message', 'like', "%{$this->query}%")
                ->limit(5)->get();

            $messages = Message::where('body', 'like', "%{$this->query}%")
                ->limit(5)->get();

            $specials = SpecialContentItem::where('title', 'like', "%{$this->query}%")
                ->orWhere('content', 'like', "%{$this->query}%")
                ->limit(5)->get();
        }

        return view('livewire.admins.search.index', compact(
            'users', 'testimonies', 'contacts', 'feedback', 'messages', 'specials'
        ))
            ->layout('components.layouts.admin', ['title' => 'Search']);
    }
}
