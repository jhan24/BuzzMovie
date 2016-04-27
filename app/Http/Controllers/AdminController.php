<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class AdminController extends Controller
{
    public function showUserList() {
        $users = User::all();
        return view('admin', ['users' => $users]);
    }

    public function toggleBan($id) {
        $user = User::find($id);
        $user->isBanned = !$user->isBanned;
        $user->save();
        return redirect()->route('showUserList');

    }
}
