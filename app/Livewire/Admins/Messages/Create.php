<?php

namespace App\Livewire\Admins\Messages;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public string $subject = '';
    public string $body = '';
    public ?string $userId = null;
    public ?string $contextType = null;
    public ?string $contextId = null;

    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'userId' => ['required', Rule::exists('users', 'id')],
            'contextType' => ['nullable', 'string'],
            'contextId' => ['nullable', 'integer'],
        ];
    }

    public function createMessage(): RedirectResponse
    {
        $this->validate();

        $message = Message::create([
            'uuid' => (string) Str::uuid(),
            'subject' => $this->subject,
            'body' => $this->body,
            'user_id' => $this->userId,
            'admin_id' => auth()->guard('admin')->id(), // assumes separate guard
            'context_type' => $this->contextType,
            'context_id' => $this->contextId,
            'sent_at' => null,
        ]);

        session()->flash('status', 'Message created.');

        // return redirect()->route('admins.messages.show', $message->uuid);
        return redirect()->route('admins.messages.index');
    }

    public function render()
    {
        return view('livewire.admins.messages.create', [
            'users' => User::all(),
        ])->layout('components.layouts.admin', [
            'title' => 'Create Message',
        ]);
    }
}
