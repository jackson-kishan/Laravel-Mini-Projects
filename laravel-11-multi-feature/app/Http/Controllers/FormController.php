<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FormController extends Controller
{

    public function create()
    {
        return view('Task1.createUser');
    }

    public function store(Request $request): RedirectResponse
    {

        $validateData = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:5',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);

        return back()->with('success',  "Use created Successfully");

    }
}
