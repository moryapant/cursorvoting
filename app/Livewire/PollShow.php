<?php

namespace App\Livewire;

use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PollShow extends Component
{
    public $poll;
    public $voteCounts;
    public $userVote;
    public $isArchived;

    public function mount(Poll $poll)
    {
        $this->poll = $poll->load('options.actress');
        $this->isArchived = $poll->archived;
        $this->loadVotes();
        $this->userVote = $this->getUserVote();
    }

    private function loadVotes()
    {
        $this->voteCounts = DB::table('votes')
            ->select('poll_option_id', DB::raw('count(*) as count'))
            ->where('poll_id', $this->poll->id)
            ->groupBy('poll_option_id')
            ->pluck('count', 'poll_option_id')
            ->toArray();
    }

    private function getUserVote()
    {
        return DB::table('votes')
            ->where('poll_id', $this->poll->id)
            ->where('user_id', auth()->id())
            ->value('poll_option_id');
    }

    public function vote($optionId)
    {
        if ($this->isPollEnded()) {
            session()->flash('error', 'This poll has ended.');

            return;
        }

        DB::table('votes')->updateOrInsert(
            ['poll_id' => $this->poll->id, 'user_id' => auth()->id()],
            ['poll_option_id' => $optionId]
        );

        $this->loadVotes();
        $this->userVote = $optionId;
    }

    private function isPollEnded()
    {
        return Carbon::parse($this->poll->end_date)->isPast();
    }

    public function render()
    {
        return view('livewire.poll-show');
    }

    public function getTotalVotes()
    {
        return array_sum($this->voteCounts);
    }

    public function getVotePercentage($optionId)
    {
        $totalVotes = $this->getTotalVotes();
        if ($totalVotes === 0) {
            return 0;
        }

        return round(($this->voteCounts[$optionId] ?? 0) / $totalVotes * 100, 1);
    }

    public function archivePoll()
    {
        if (auth()->user()->email !== 'morya123@gmail.com') {
            session()->flash('error', 'You are not authorized to archive polls.');

            return;
        }

        if (!$this->isPollEnded()) {
            session()->flash('error', 'Only ended polls can be archived.');

            return;
        }

        $this->poll->archived = true;
        $this->poll->save();

        session()->flash('success', 'Poll archived successfully.');

        return redirect()->route('polls.archive');
    }

    public function deletePoll()
    {
        if (auth()->user()->email !== 'morya123@gmail.com') {
            session()->flash('error', 'You are not authorized to delete polls.');

            return;
        }

        if (!$this->isPollEnded()) {
            session()->flash('error', 'Only ended polls can be deleted.');

            return;
        }

        DB::transaction(function () {
            // Delete related votes
            DB::table('votes')->where('poll_id', $this->poll->id)->delete();

            // Delete poll options
            $this->poll->options()->delete();

            // Finally, delete the poll
            $this->poll->delete();
        });

        session()->flash('success', 'Poll and related data deleted successfully.');

        return redirect()->route('home');
    }
}
