<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PollCard extends Component
{
    public $poll;

    public function mount($poll)
    {
        $this->poll = is_array($poll) ? (object) $poll : $poll;
    }

    public function render()
    {
        return view('livewire.poll-card', [
            'daysLeft' => $this->getDaysLeft(),
        ]);
    }

    private function getDaysLeft()
    {
        $endDate = Carbon::parse($this->poll->end_date);
        $now = Carbon::now();

        if ($now->gt($endDate)) {
            return 'Ended';
        }

        $diffInDays = $now->diffInDays($endDate, false); // Use false to get the absolute number of days
        $diffInDays = floor($diffInDays); // Round down to the nearest integer

        if ($diffInDays == 0) {
            return 'Ends today';
        }

        return $diffInDays.' day'.($diffInDays != 1 ? 's' : '');
    }
}
