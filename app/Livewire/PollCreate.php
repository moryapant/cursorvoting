<?php

namespace App\Livewire;

use App\Models\Actress;
use App\Models\Poll; // Add this at the top of the file
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class PollCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $category;
    public $endDate;
    public $options = [];
    public $categories = ['Technology', 'Politics', 'Entertainment', 'Sports', 'Other'];
    public $pollImage;

    protected $rules = [
        'title' => 'required|min:3',
        'category' => 'required',
        'endDate' => 'required|date|after:today',
        'options' => 'required|array|min:2',
        'options.*.actress_id' => 'required|exists:actresses,id',
        'options.*.image' => 'nullable|image|max:1024', // 1MB Max
        'pollImage' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function mount()
    {
        $this->options = [
            ['actress_id' => '', 'image' => null],
            ['actress_id' => '', 'image' => null],
        ];
    }

    public function addOption()
    {
        $this->options[] = ['actress_id' => '', 'image' => null];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $pollImagePath = null;
                if ($this->pollImage) {
                    $pollImagePath = $this->pollImage->store('poll-images', 'public');
                }

                $poll = Poll::create([
                    'title' => $this->title,
                    'category' => $this->category,
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::parse($this->endDate),
                    'image' => $pollImagePath,
                ]);

                foreach ($this->options as $option) {
                    $optionImagePath = null;
                    if ($option['image']) {
                        $optionImagePath = $option['image']->store('option-images', 'public');
                    }

                    $poll->options()->create([
                        'actress_id' => $option['actress_id'],
                        'image' => $optionImagePath,
                    ]);
                }
            });

            session()->flash('message', 'Poll created successfully!');
            $this->reset(['title', 'category', 'endDate', 'options', 'pollImage']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create poll. '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.poll-create', [
            'actresses' => Actress::all(),
        ]);
    }
}
