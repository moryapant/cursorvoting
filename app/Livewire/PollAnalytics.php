<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class PollAnalytics extends Component
{
    public Poll $poll;

    public function mount(Poll $poll)
    {
        $this->poll = $poll;
    }

    public function render()
    {
        $voteCounts = $this->poll->votes()->count();

        return view('livewire.poll-analytics', [
            'voteCounts' => $voteCounts,
        ]);
    }
}
