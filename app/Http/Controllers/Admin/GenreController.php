<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // $limit = 5; //tùy chọn, số dòng/ trang
        // $page = $req->page > 0 ? $req->page : 1; // trang hiện tại đang truy cập
       
        // $genres = Genre::paginate($limit,['*'],'page',$page);
        
        // return view("genres.index",compact("genres","page"));
        

        $limit = 5; //tùy chọn, số dòng/ trang
        $page = $req->page > 0 ? $req->page : 1; // trang hiện tại đang truy cập
        //values:id, tit, desc, thum, release_date, vote, like
        $genres = Genre::paginate($limit, ['*'], 'page', $page);
        $count = $genres->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'name' => ['string', 'Thể loại'],
            'status' => ['boolean','Trạng thái']
        ];
        $values = $genres;
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
        return view("admin.create.genre");
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
            "name" =>"required|string|max:255",
            "status"=>"required"
        ]);
        Genre::create($validated);
        return redirect()->route("admin.genres.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $gen)
    {
        return view("genres.show",compact("gen"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre,$id)
    {
        return view("admin.create.genre",[
            'v'=>$genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Genre $genre,$id)
    {
        $validated = $req->validate([
            "name" =>"required|string|max:255",
            "status"=>"required"
        ]);
        $genre->update($validated);
        return redirect()->route("admin.genres.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre,$id)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index');
    }
}
