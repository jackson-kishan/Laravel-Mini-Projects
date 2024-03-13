<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
   
    public function __construct() {

        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-user', ['only' => ['create-user', 'edit-user']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('users.index', [
            'users' => User::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
       return view('users.create', [
         'roles' => Role::pluck('name')->all()
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
               ->withSuccess('New user added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if($user->hasRole('Super Admin')) {
            if($user->id != auth()->user()->id) {
                abort(403, "User does not have the right permissions to edit");
            }
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRole' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {
        
        $input = $request->all();

        if(!empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        } else {
            $input = $request->expcet('password');
        }

        $user->update($input);
        $user->syncRoles($request->roles);

        return redirect()->back()
               ->withSuccess('User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        //about if user is super admin or User id bolongs to auth user
        if($user->hasRole('Super Admin') || $user->id == auth()->user()->id) {
            abort(403, "USER DOSE NOT HAVE THE RIGHT PERMISSION");
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
                  ->withSuccess('User deleted successfully');

    }
}
