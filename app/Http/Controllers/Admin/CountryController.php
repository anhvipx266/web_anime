<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        
        $countries =Country::search($req)->paginate($limit, ['*'], 'page', $page);
        $count = $countries->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'name' => ['string', 'Quốc gia']
        ];
        $values = $countries;
        $title = 'Quốc gia';
        $for = 'countries';
        $searchBy = 'Tìm theo tên...';
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
        return view('admin.create.country');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validated = $req->validate([
            'name'=>'string|required|max:255',
        ],[
            'title.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
       
        Country::create($validated);
        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('admin.create.country',[
            'v'=>$country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Country $country)
    {
        $validated = $req->validate([
            'name'=>'string|required|max:255',
        ],[
            'title.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
       
        $country->update($validated);
        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
    }
}
