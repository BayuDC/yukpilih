<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller {
    public function index() {
        return view('home');
    }
    public function create() {
        return view('poll.create');
    }
    public function store(Request $request) {
        $validated = $request = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
        ]);
    }
}
