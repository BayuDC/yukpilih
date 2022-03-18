<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;

class UserController extends Controller {
    public function create() {
        return view('user.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9\_]+$/|unique:App\Models\User,username',
            'division' => 'required|exists:App\Models\Division,name'
        ]);

        $user = new User;
        $user->username = $validated['username'];
        $user->password = bcrypt('12345');
        $user->role = 'user';
        $user->division_id = Division::where('name', $validated['division'])->first()->id;
        $user->save();

        return redirect('/user/create')->with('status', 'success');
    }
}
