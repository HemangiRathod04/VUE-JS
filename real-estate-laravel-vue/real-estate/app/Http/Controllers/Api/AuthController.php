<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(request $request)
    {
        $credential=$request->only('email','password');
        if(Auth::attempt($credential)){
            $user=Auth::user();
            $token = $user->createToken('LaravelPassportAPI')->accessToken;
            return response()->json([
                'messge'=>'Login Successfully',
                'token'=>$token,
                'user'=>$user,
            ],200);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->token()->revoke();
            return response()->json([
                'message' => 'Logout Successful',
            ], 200);
        } else {
            return response()->json([
                'error' => 'User is not authenticated',
            ], 401);
        }
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role_id'] = $validatedData['role'];
        $user = User::create($validatedData);
        $token = $user->createToken('LaravelPassportAPI')->accessToken;
        return response()->json([
            'message' => 'Registration Successful',
            'token' => $token,
            'user' => $user,
        ], 201);
    }
}
