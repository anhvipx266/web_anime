<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    //
    public function signin(){
        return view('accounts.users.signin');
    }
    public function login(Request $req){
        $validated = $req->validate([
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255'
        ],[

        ]);

        $user = User::where('email', $validated['email'])->first();
        if(Hash::check($validated['password'], $user->password)){
            Auth::guard('staff')->attempt($validated);
            // auth()->attempt($validated);
            return redirect()->route('home');
        }
        else{
            return redirect()->route('accounts.signin');
        }
    }
    public function signup(Request $req){
        return view('accounts.users.signup');
    }
    public function register(Request $req){
        $validated = $req->validate([
            'name'=>'string|required|max:255',
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255',
        ]);
        // ktr unique email
        if(User::where('email', $validated['email'])->first()){
            return redirect()->route('accounts.signup');
        }
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('accounts.signin');
    }
    public function logout(Request $req){
        auth()->guard('staff')->logout();
        return redirect()->route('home');
    }
}
