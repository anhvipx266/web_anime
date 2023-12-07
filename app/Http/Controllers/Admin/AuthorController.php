<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
        $authors = Author::paginate($limit, ['*'], 'page', $page);
        $count = $authors->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'name' => ['string', 'Tác giả']
        ];
        $values = $authors;
        $title = 'Tác giả';
        $for = 'authors';
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
        return view('admin.create.author');
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
       
        Author::create($validated);
        return redirect()->route('admin.authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.create.author',[
            'v'=>$author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Author $author)
    {
        $validated = $req->validate([
            'name'=>'string|required|max:255',
        ],[
            'title.required'=> 'Vui lòng nhập tên',
            'email.required'=> 'Vui lòng Email',
            'password.required'=> 'Vui lòng mật khẩu',
            'password.min'=> 'Mật khẩu tối thiểu 8 kí tự',
        ]);
       
        $author->update($validated);
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
    }
}
