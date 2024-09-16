<?php

namespace App\Http\Controllers;

use App\Models\Poll;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::latest()->paginate(10);

        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        if (auth()->user()->email !== 'morys123@gmail.com') {
            abort(403, 'Unauthorized action.');
        }

        return view('polls.create');
    }

    // Other methods...
}
