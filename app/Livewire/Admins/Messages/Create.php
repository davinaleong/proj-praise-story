<?php

namespace App\Livewire\Admins\Messages;

use App\Models\Message;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminsMessagesMail;

class Create extends Component
{
    public string $subject = '';
    public string $body = '';
    public ?string $user_uuid = null;
    public ?string $context_type = null;
    public ?string $context_uuid = null;

    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user_uuid' => ['nullable', 'exists:users,uuid'],
            'context_type' => ['nullable', 'string'],
            'context_uuid' => ['nullable', 'integer'],
        ];
    }

    public function createMessage()
    {
        $this->validate();

        $user = User::where('uuid', $this->user_uuid)
            ->firstOrFail();

        $context_id = null;

        if ($this->context_type && $this->context_uuid) {
            $contextClass = $this->context_type;

            if (class_exists($contextClass)) {
                $contextModel = $contextClass::where('uuid', $this->context_uuid)->first();

                if ($contextModel) {
                    $context_id = $contextModel->id;
                }
            }
        }

        $message = Message::create([
            'uuid' => (string) Str::uuid(),
            'subject' => $this->subject,
            'body' => $this->body,
            'user_id' => $user->id,
            'admin_id' => auth()->guard('admin')->id(),
            'context_type' => $this->context_type,
            'context_id' => $context_id,
            'sent_at' => null,
        ]);

        session()->flash('status', 'Message created.');

        Mail::to($message->user->email)->send(new AdminsMessagesMail($message));

        $message->update(['sent_at' => now()]);

        return redirect()->route('admins.messages.show', $message->uuid);
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
