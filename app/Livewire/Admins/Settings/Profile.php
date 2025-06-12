<?php

namespace App\Livewire\Admins\Settings;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Rules\NoProfanity;

class Profile extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $admin = Auth::guard('admin')->user();
        $this->name = $admin->name;
        $this->email = $admin->email;
    }

    /**
     * Update the profile information for the currently authenticated admin.
     */
    public function updateProfileInformation(): void
    {
        $admin = Auth::guard('admin')->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255', new NoProfanity],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Admin::class)->ignore($admin->id),
                new NoProfanity,
            ],
        ]);

        $admin->fill($validated);

        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        $admin->save();

        $this->dispatch('profile-updated', name: $admin->name);
    }

    /**
     * Send an email verification notification to the current admin.
     */
    public function resendVerificationNotification(): void
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('admins.dashboard', absolute: false));
            return;
        }

        $admin->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.admins.settings.profile')
            ->layout('components.layouts.admin', ['title' => 'Admin Profile Settings']);
    }
}
