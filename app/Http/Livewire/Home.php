<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $topUsers;
    public $polls;

    public function mount()
    {
        $this->topUsers = User::orderBy('points', 'desc')->take(3)->get();
        $this->polls = Poll::latest()->get();
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function vote($pollId)
    {
        $poll = Poll::find($pollId);
        if ($poll) {
            return redirect()->route('polls.show', $poll);
        }
    }
}
