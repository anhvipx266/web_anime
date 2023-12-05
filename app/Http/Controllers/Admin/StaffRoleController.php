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
        $staff_roles = StaffRole::paginate($limit, ['*'], 'page', $page);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffRole $staffRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffRole  $staffRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffRole $staffRole)
    {
        //
    }
}
