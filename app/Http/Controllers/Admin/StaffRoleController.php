<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffRole;
use Illuminate\Http\Request;

class StaffRoleController extends Controller
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
        
        $staff_roles = StaffRole::search($req)->paginate($limit, ['*'], 'page', $page);
        $count = $staff_roles->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'role' => ['string', 'Vai trò']
        ];
        $values = $staff_roles;
        $title = 'Vai trò nhân viên';
        $for = 'staff_roles';
        $searchBy = 'Tìm theo vai trò';
        return view("data_manage.index", compact(
            "page",
            'types',
            'values',
            'title',
            'count',
            'for',
            'searchBy','req'
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
        return view('admin.create.staff_role');
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
            'role'=>'string|required|max:255',
        ],[
            // 'title.required'=> 'Vui lòng nhập tên',
            // 'email.required'=> 'Vui lòng Email',
            // 'password.required'=> 'Vui lòng mật khẩu',
            // 'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
       
        StaffRole::create($validated);
        return redirect()->route('admin.staff_roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function show(StaffRole $staffRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffRole $staffRole)
    {
        return view('admin.create.staff_role',[
            'v'=>$staffRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, StaffRole $staffRole)
    {
        $validated = $req->validate([
            'role'=>'string|required|max:255',
        ],[
            // 'title.required'=> 'Vui lòng nhập tên',
            // 'email.required'=> 'Vui lòng Email',
            // 'password.required'=> 'Vui lòng mật khẩu',
            // 'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
       
        $staffRole->update($validated);
        return redirect()->route('admin.staff_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffRole $staffRole)
    {
        $staffRole->delete();
    }
}
