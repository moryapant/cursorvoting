<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class PollArchive extends Component
{
    public function render()
    {
        $archivedPolls = Poll::where('archived', true)->latest()->get();

        return view('livewire.poll-archive', compact('archivedPolls'));
    }
}
