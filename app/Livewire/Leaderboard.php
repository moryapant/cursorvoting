<?php

namespace App\Livewire;

use App\Models\Actress;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Leaderboard extends Component
{
    public $topActresses;

    public function mount()
    {
        $this->loadTopActresses();
    }

    private function loadTopActresses()
    {
        $this->topActresses = Actress::select('actresses.id', 'actresses.name', DB::raw('COUNT(votes.id) as vote_count'))
            ->leftJoin('poll_options', 'actresses.id', '=', 'poll_options.actress_id')
            ->leftJoin('votes', 'poll_options.id', '=', 'votes.poll_option_id')
            ->groupBy('actresses.id', 'actresses.name')
            ->orderByDesc('vote_count')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.leaderboard');
    }
}
