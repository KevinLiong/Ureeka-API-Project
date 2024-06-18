<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    public function registerUser(Request $request){
        // $email_unique = User::find($request->email);

        if(User::find($request->email) != null) return response()->json("Register Failed");

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        if($user){
            return response()->json($user);
        }
        else{
            return response()->json("Register Failed");
        }
    }

    public function loginUser(Request $request){
        if(Auth::attempt($request->only('email', 'password'))) {    
            // $request->session()->regenerate();
            return response()->json("Logged In");
        }
        else{
            return response()->json("Login Failed");
        }
    }

    public function logOutUser(Request $request){
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return response()->json("Logged Out");
    }
}
