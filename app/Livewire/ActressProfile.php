<?php

namespace App\Livewire;

use App\Models\Actress;
use Livewire\Component;

class ActressProfile extends Component
{
    public Actress $actress;

    public function mount(Actress $actress)
    {
        $this->actress = $actress;
    }

    public function render()
    {
        $recentPolls = $this->actress->polls()->latest()->take(5)->get();
        $rankings = $this->actress->rankings()->take(10)->get();

        return view('livewire.actress-profile', [
            'recentPolls' => $recentPolls,
            'rankings' => $rankings,
        ]);
    }
}
