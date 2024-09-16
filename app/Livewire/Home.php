<?php

namespace App\Livewire;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $polls = Poll::with('options.actress')
            ->where('archived', false)
            ->latest()
            ->get();

        $topUsers = User::orderBy('points', 'desc')
            ->take(3)
            ->get();

        return view('livewire.home', compact('polls', 'topUsers'));
    }

    public function vote($pollId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Implement voting logic here
        // ...

        return redirect()->route('home');
    }
}
