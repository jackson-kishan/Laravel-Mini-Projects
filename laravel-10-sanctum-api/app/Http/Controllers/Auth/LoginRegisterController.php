<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /* Register a New User */
    
    public function register(Request $request) {
        
        $validate = Validator::make($request->all(), [
          'name' => 'required|string|max:100',
          'email' => 'required|string|max:100|unique:users,email',
          'password' => 'required|string|min:8|confirmed'
        ]);

        if($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation failed',
                'data' => $validate->errors(),
            ], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'User is created successfully',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

   /* Authenticate the User */

   public function login(Request $request) {

     $validate = Validator::make($request->all(), [
         'email' => 'required|string|email',
         'password' => 'required|string',
     ]);

     if($validate->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validate->errors(),
        ], 403);
     }

     //check user exist
     $user = User::where('email', '=', $request->email)->first();

     //check password
     if(!$user || !Hash::check($user->password, $request->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid user',
        ], 403);
     }

     $data['token'] = $user->createToken($request->email)->plainTextToken;
     $data['user'] = $user;

     $response = [
        'status' => 'success',
        'message' => 'User is Successfully logged in',
        'data' => $data,
     ];

     return response()->json($response);
   }

   public function logout(Request $request) {
    auth()->user()->tokens()->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'user successfully logged out',
    ], 200);
   }

}
