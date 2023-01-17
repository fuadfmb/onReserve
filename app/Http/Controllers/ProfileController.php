<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function editProfile(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'profile_pic' => 'required',
            'bio' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        if ($user->profile == null) {
            return $user->profile()->create(
                $request->all()
            );
        } else {
            return $user->profile()->update(
                $request->all()
            );
        }
    }

    public function getProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return $user->profile;
    }
}
