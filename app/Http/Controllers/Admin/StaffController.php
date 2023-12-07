<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffRole;
use Illuminate\Http\Request;
use Storage;
use Hash;

class StaffController extends Controller
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
        $staffs = Staff::getDetails()
            ->paginate($limit, ['*'], 'page', $page);
        $count = $staffs->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'name' => ['string', 'Tên'],
            'role' => ['string', 'Vai trò'],
            'avatar' => ['image', 'Avatar'],
            'email' => ['string', 'Email'],
            'phone' => ['string', 'SDT'],
            'gender' => ['boolean', 'Giới tính'],
            'status' => ['boolean', 'Trạng thái'],
        ];
        $values = $staffs;
        $title = 'Nhân viên';
        $for = 'staffs';
        return view("data_manage.index", compact(
            "page",
            'types',
            'values',
            'title',
            'count',
            'for'
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
        $staff_roles = StaffRole::all();
        // dd($staff_roles);
        return view('admin.create.staff',compact(
            'staff_roles'
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
            'staff_roles' => 'integer|required',
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
        Staff::create($validated);
        return redirect()->route('admin.staffs.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $staff_roles = StaffRole::all();
        $v = $staff;
        // dd($staff_roles);
        return view('admin.create.staff',compact(
            'staff_roles','v'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Staff $staff)
    {
         // dd($req->all());
         $validated = $req->validate([
            'name'=>'string|required|max:255',
            'staff_roles' => 'integer|required',
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
        $staff->update($validated);
        return redirect()->route('admin.staffs.index');
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
