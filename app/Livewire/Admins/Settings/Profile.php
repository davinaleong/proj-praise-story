<?php

namespace App\Livewire\Admins\Settings;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Admin::class)->ignore($admin->id),
            ],
        ]);

        $admin->fill($validated);

        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        $admin->save();

        $this->dispatch('profile-updated', name: $admin->name);
    }

    public function render()
    {
        return view('livewire.admins.settings.profile')
            ->layout('components.layouts.admin', ['title' => 'Admin Profile Settings']);
    }
}
