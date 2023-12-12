<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Storage;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $limit = 10; //tùy chọn, số dòng/ trang
        $page = $req->page > 0 ? $req->page : 1; // trang hiện tại đang truy cập
        //values:id, tit, desc, thum, release_date, vote, like
        
        $users = User::search($req)
            ->paginate($limit, ['*'], 'page', $page);
        $count = $users->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'name' => ['string', 'Tên'],
            'avatar' => ['image','Avatar'],
            'role' => ['string', 'Vai trò'],
            'email' => ['string', 'Email'],
            'gender' => ['boolean', 'Giới tính'],
            'status' => ['boolean', 'Trạng thái'],
        ];
        $values = $users;
        $title = 'Người dùng';
        $for = 'users';
        $searchBy = 'Tìm theo tên người dùng';
        return view("data_manage.index", compact(
            "page",
            'types',
            'values',
            'title',
            'count',
            'for','searchBy','req'
        )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_roles = UserRole::all();
        return view('admin.create.user',compact(
            'user_roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // dd($req->all());
        $validated = $req->validate([
            'name'=>'string|required|max:255',
            'user_role' => 'integer|required',
            'email' => 'string|required|max:255',
            'password'=>'string|required|max:255',
            'phone' => 'string|required|max:255',
            'gender' => 'integer|required',
            'status'=>'integer|required',
            'avatar_file'=>'image|mimes:jpg,jpeg,png,gif|max:10000',
            
            // 'release_date'=>'date'
            // 'thumbnail'=>'url|required',
            // 'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        // dd(1);
        $validated['password'] = Hash::make($validated['password']);
        // tải file thế link
        if ($req->hasFile('avatar_file')) {
            $avatar = $req->file('avatar_file');
            
            $path = $avatar->store('public/imgs/avatars');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['avatar'] = Storage::url($path);
        }
        User::create($validated);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_roles = UserRole::all();
        $v = $user;
        return view('admin.create.user',compact(
            'user_roles','v'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, User $user)
    {
        $validated = $req->validate([
            'name'=>'string|required|max:255',
            'user_role' => 'integer|required',
            'email' => 'string|required|max:255',
            'password'=>'string|required|max:255',
            'phone' => 'string|required|max:255',
            'gender' => 'integer|required',
            'status'=>'integer|required',
            'avatar_file'=>'image|mimes:jpg,jpeg,png,gif|max:10000',
            
            // 'release_date'=>'date'
            // 'thumbnail'=>'url|required',
            // 'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        // dd(1);
        $validated['password'] = Hash::make($validated['password']);
        // tải file thế link
        if ($req->hasFile('avatar_file')) {
            $avatar = $req->file('avatar_file');
            
            $path = $avatar->store('public/imgs/avatars');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['avatar'] = Storage::url($path);
        }
       $user->update($validated);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
    }
}
