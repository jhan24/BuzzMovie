<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function editProfile(Request $request) {
        $currentUser = Auth::user();
        $data = $request->only(['name', 'email', 'password', 'major']);
        if ($data['email'] == $currentUser->email) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'major' => 'required|max:255',
                'password' => 'min:6|confirmed',
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'major' => 'required|max:255',
                'password' => 'min:6|confirmed',
            ]);
        }
        $this->edit($data);
        return view('profile', ['user' => Auth::user()]);
    }
    protected function edit(array $data)
    {
        $currentUser = Auth::user();
        $currentUser->name = $data['name'];
        $currentUser->major = $data['major'];
        $currentUser->email = $data['email'];
        if ($data['password'] != NULL) {
            $currentUser->password = bcrypt($data['password']);
        }
        $currentUser->save();
    }
}
