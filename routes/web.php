<?php

use App\Livewire\ActressProfile;
use App\Livewire\FanBattle;
use App\Livewire\Home;
use App\Livewire\Leaderboard;
use App\Livewire\PollAnalytics;
use App\Livewire\PollArchive;
use App\Livewire\PollCreate;
use App\Livewire\PollIndex;
use App\Livewire\PollShow;
use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', Home::class)->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/polls', PollIndex::class)->name('polls.index');

    // Update the poll show route
    Route::get('/polls/{poll}', PollShow::class)->name('polls.show');
    Route::get('/polls/{poll}', PollShow::class)->name('polls.show')
        ->missing(function () {
            return redirect()->route('polls.index')->with('error', 'Poll not found.');
        });

    Route::get('/poll/create', PollCreate::class)->name('polls.create');
    Route::get('/leaderboard', Leaderboard::class)->name('leaderboard');
    Route::get('/actress/{actress}', ActressProfile::class)->name('actress.profile');
    Route::get('/fan-battle', FanBattle::class)->name('fan-battle');
    Route::get('/archive', PollArchive::class)->name('polls.archive');
});

// Fallback route for SPA
// Route::get('/{any}', Home::class)->where('any', '.*');

// Remove or comment out this line if it exists
// Route::get('/polls/archive', PollArchive::class)->name('polls.archive');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{user}', UserProfile::class)->name('user.profile');
    Route::get('/polls/{poll}/analytics', PollAnalytics::class)->name('polls.analytics');
});
