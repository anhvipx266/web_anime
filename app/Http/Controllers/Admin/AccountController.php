<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    //
    public function signin(){
        return view('accounts.signin');
    }
    public function login(Request $req){
        $rules = [
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255|min:8'
        ];
        $messages = [
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ];
        $validated = $req->validate($rules);

        $staff = Staff::where('email', $validated['email'])->first();
        if(Hash::check($validated['password'], $staff->password)){
            Auth::guard('staff')->attempt($validated);
            // auth()->attempt($validated);
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->route('admin.accounts.signin');
        }
    }
    public function signup(Request $req){
        return view('accounts.signup');
    }
    public function register(Request $req){
        $validated = $req->validate([
            'name'=>'string|required|max:255',
            'email'=>'email|required|max:255',
            'password'=>'string|required|max:255|min:8',
            'phone'=>'string|required|max:255',
            'gender' => 'integer|required',
            'address'=>'string',
            'avatar'=>'image|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            'name.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
        // ktr unique email
        if(Staff::where('email', $validated['email'])->first()){
            return redirect()->route('accounts.signup');
        }
        $validated['password'] = Hash::make($validated['password']);
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            // $path = $avatar->store('public/imgs/avatars');
            $path = $avatar->store('public/imgs/avatars');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['avatar'] = Storage::url($path);
        }
        Staff::create($validated);
        return redirect()->route('admin.accounts.signin');
    }
    public function logout(Request $req){
        auth()->guard('staff')->logout();
        return redirect()->route('admin.home');
    }
}
