<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Poll;
use App\Models\Vote;
use App\Models\Division;

class PollController extends Controller {
    public function index() {
        $polls = Poll::with(['creator', 'choices'])->orderBy('created_at', 'desc')->get();
        $divisions = Division::with('votes')->get();

        foreach ($polls as $poll) {
            $poll->totalPoint = 0;

            foreach ($divisions as $division) {
                $maxCount = 0;
                $winners = [];

                foreach ($poll->choices as $choice) {
                    $count = $division->votes->where('choice_id', $choice->id)->count();

                    if ($maxCount < $count) {
                        $maxCount = $count;
                        $winners = [$choice];
                    } else if ($maxCount == $count && $maxCount != 0) {
                        array_push($winners, $choice);
                    }
                }

                foreach ($winners as $winner) {
                    $point = 1 / count($winners);

                    if (!$winner->point) $winner->point = $point;
                    else $winner->point += $point;

                    $poll->totalPoint += $point;
                }
            }
        }

        return view('poll.index', [
            'polls' => $polls
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
    public function storeVote(Poll $poll, Request $request) {
        if (Gate::denies('vote-poll', $poll)) abort(403);

        $request->validate([
            'choice' => 'exists:App\Models\Choice,id',
        ]);

        $vote = new Vote;
        $vote->poll_id = $poll->id;
        $vote->choice_id = $request->choice;
        $vote->user_id = Auth::user()->id;
        $vote->division_id = Auth::user()->division->id;
        $vote->save();

        return redirect('/poll');
    }
}
