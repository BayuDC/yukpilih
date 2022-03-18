<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    public function create() {
        return view('user.create');
    }
    public function store(Request $request) {
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9\_]+$/',
            'division' => 'required|exists:App\Models\Division,name'
        ]);


        return 'OK';
    }
}
