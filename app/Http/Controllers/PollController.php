<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'choice1' => 'required',
            'choice2' => 'required',
        ]);

        $poll = new Poll;
        $poll->title = $request->title;
        $poll->description = $request->description;
        $poll->deadline = $request->deadline;
        $poll->created_by = Auth::user()->id;
        $poll->save();

        $choice = new Choice;
        $choice->choice = $request->choice1;
        $choice->poll_id = $poll->id;
        $choice->save();

        $choice = new Choice;
        $choice->choice = $request->choice2;
        $choice->poll_id = $poll->id;
        $choice->save();

        if ($request->choice3) {
            $choice = new Choice;
            $choice->choice = $request->choice3;
            $choice->poll_id = $poll->id;
            $choice->save();
        }

        return redirect('/poll');
    }
    public function storeVote(Request $request) {
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
