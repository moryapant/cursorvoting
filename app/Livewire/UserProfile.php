<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public $avatar;
    public $bio;

    protected $rules = [
        'user.name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'avatar' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->bio = $user->bio;
    }

    public function updateProfile()
    {
        // Debugging statement
        logger('updateProfile method called');

        $this->validate();

        if ($this->avatar) {
            // Delete old avatar if exists
            if ($this->user->avatar) {
                Storage::disk('public')->delete($this->user->avatar);
            }

            // Store new avatar
            $avatarPath = $this->avatar->store('avatars', 'public');
            $this->user->avatar = $avatarPath;
        }

        $this->user->bio = $this->bio;
        $this->user->save();

        session()->flash('message', 'Profile updated successfully.');
    }

    public function deleteAvatar()
    {
        if ($this->user->avatar) {
            Storage::disk('public')->delete($this->user->avatar);
            $this->user->avatar = null;
            $this->user->save();
        }

        session()->flash('message', 'Avatar deleted successfully.');
    }

    public function render()
    {
        $votingHistory = $this->user->votes()->with('poll')->latest()->take(10)->get();
        $totalVotes = $this->user->votes()->count();

        return view('livewire.user-profile', [
            'votingHistory' => $votingHistory,
            'totalVotes' => $totalVotes,
        ]);
    }
}
