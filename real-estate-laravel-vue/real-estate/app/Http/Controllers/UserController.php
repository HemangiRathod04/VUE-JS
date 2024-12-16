<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users=User::with('roles')->get();
        return response()->json([
            'message' => 'Users Retrieved Successfully',
            'users' => $users,
        ]);
    }
}
