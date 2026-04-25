<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function activeUser(Request $request){

      $users = User::select("*")
                    ->whereNotNull('last_seen')
                    ->orderBy('last_seen', 'DESC')
                    ->paginate(10);

        // dd('users', $users);

      return view('users.active-users', compact('users'));
    }
}
