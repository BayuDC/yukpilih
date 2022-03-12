<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;

class PollController extends Controller {
    public function index() {
        return view('home');
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
}
