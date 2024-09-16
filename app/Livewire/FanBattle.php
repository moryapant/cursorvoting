<?php

namespace App\Livewire;

use App\Models\Actress;
use Livewire\Component;

class FanBattle extends Component
{
    public $actress1;
    public $actress2;
    public $category;
    public $votedFor;
    public $votes = [];

    public function mount()
    {
        $this->selectRandomActresses();
    }

    public function render()
    {
        return view('livewire.fan-battle');
    }

    public function selectRandomActresses()
    {
        $actresses = Actress::inRandomOrder()->take(2)->get();
        $this->actress1 = $actresses[0];
        $this->actress2 = $actresses[1];
        $this->category = $this->getRandomCategory();
        $this->votedFor = null;
        $this->votes = [
            $this->actress1->id => 0,
            $this->actress2->id => 0,
        ];
    }

    public function vote($actressId)
    {
        if ($this->votedFor) {
            return;
        }

        $this->votedFor = $actressId;
        ++$this->votes[$actressId];

        // Here you would typically save the vote to the database
        // For simplicity, we're just updating the local state
    }

    private function getRandomCategory()
    {
        $categories = ['Acting Skills', 'Style', 'Fan Following', 'Versatility'];

        return $categories[array_rand($categories)];
    }
}
