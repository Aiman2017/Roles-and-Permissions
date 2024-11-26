<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AssignToUser extends Controller
{

    public function create()
    {
        return view('backend..assignToUser.create',
            [
                'roles' => Role::query()->get(),
                'users' => User::query()->with('roles')->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'user_id' => 'required',
        ],
        [
            'role_id.required' => 'The role field is required.',
            'user_id.required' => 'The user field is required.',
        ]);

        $user = User::query()->find($request->user_id);
        if  ($user) {
            $user->roles()->attach($request->role_id);
        }
        return redirect()->back() ->withInput();

    }
}
