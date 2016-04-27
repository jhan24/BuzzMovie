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
        $this->validate($request, [
            'name' => 'required|max:255',
            'major' => 'required|max:255',
            'password' => 'min:6|confirmed',
        ]);
        $data = $request->only(['name', 'password', 'major']);
        $this->edit($data);
        return view('profile', ['user' => Auth::user()]);
    }
    protected function edit(array $data)
    {
        $currentUser = Auth::user();
        $currentUser->name = $data['name'];
        $currentUser->major = $data['major'];
        if ($data['password'] != NULL) {
            $currentUser->password = bcrypt($data['password']);
        }
        $currentUser->save();
    }
}
