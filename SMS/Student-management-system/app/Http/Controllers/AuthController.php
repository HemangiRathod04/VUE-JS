<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|string|min:6',
            'passwordConfirmation'=>'required|',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
       $input = $request->all();
       $input['password'] = bcrypt($input['password']);
       $user = User::create($input);
       $success['token'] = $user->createToken('MyApp')->accessToken;
       $success['name'] = $user->name;

       return response()->json([
        'success' => [
            'message' => 'User successfully created.',
            'token' => $success['token'],
            'name' => $success['name']
        ]
    ], 201);
    }
   
}
