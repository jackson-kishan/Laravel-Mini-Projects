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

    public function showUsersIndex(Request $request)
    {
      $users = User::select("*");

      if($request->has('view_deleted')) {
        $users = $users->onlyTrashed();
      }

      $users = $users->paginate(10);

      return view('users.restore-users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        return back();
    }

    public function restoreUser($id)
    {
        User::withTrashed()->find($id)->restore();
    }


    public function restoreAllUsers()
    {
        User::withTrashed()->restore();
        return back();
    }
}
