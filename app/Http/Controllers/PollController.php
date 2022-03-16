<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Poll;
use App\Models\Vote;

class PollController extends Controller {
    public function index() {
        return view('poll.index', [
            'polls' => Poll::with(['creator', 'choices'])->get()
        ]);
    }
    public function create() {
        return view('poll.create');
    }
    public function store(Request $request) {
        if (Gate::denies('manage-poll')) abort(403);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'choices' => 'required|min:2'
        ]);

        $poll = new Poll;
        $poll->title = $request->title;
        $poll->description = $request->description;
        $poll->deadline = $request->deadline;
        $poll->created_by = Auth::user()->id;
        $poll->save();

        foreach ($request->choices as $choice) {
            Choice::create([
                'choice' => $choice,
                'poll_id' => $poll->id
            ]);
        }

        return redirect('/poll');
    }
    public function storeVote(Request $request) {
        if (Gate::denies('vote-poll')) abort(403);

        $request->validate([
            'poll' => 'exists:App\Models\Poll,id',
            'choice' => 'exists:App\Models\Choice,id',
        ]);

        $vote = new Vote;
        $vote->poll_id = $request->poll;
        $vote->choice_id = $request->choice;
        $vote->user_id = Auth::user()->id;
        $vote->division_id = Auth::user()->division->id;
        $vote->save();

        return redirect('/poll');
    }
}
