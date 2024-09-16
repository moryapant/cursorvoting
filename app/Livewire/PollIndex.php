<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class PollIndex extends Component
{
    public function render()
    {
        $polls = Poll::where('archived', false)->latest()->get();

        return view('livewire.poll-index', compact('polls'));
    }
}
