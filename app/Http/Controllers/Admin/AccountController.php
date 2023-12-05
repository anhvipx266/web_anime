<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function signin(){
        return view('accounts.signin');
    }
    public function login(Request $req){
        $validated = $req->validate([
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255'
        ],[

        ]);

        $staff = Staff::where('email', $validated['email'])->first();
        if(Hash::check($validated['password'], $staff->password)){
            // Auth::guard('staff')->login($staff);
            return redirect()->route('home');
        }
        else{
            return redirect()->route('accounts.signin');
        }
    }
    public function signup(Request $req){
        return view('accounts.signup');
    }
    public function register(Request $req){
        $validated = $req->validate([
            'name'=>'string|required|max:255',
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255',
            'phone'=>'string|required|max:255'
        ]);
        // ktr unique email
        if(Staff::where('email', $validated['email'])->first()){
            return redirect()->route('accounts.signup');
        }
        $validated['password'] = Hash::make($validated['password']);
        Staff::create($validated);
        return redirect()->route('accounts.signin');
    }
    public function logout(Request $req){
        auth()->logout();
        return redirect()->route('home');
    }
}
