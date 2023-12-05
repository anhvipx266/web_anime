<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
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
        $movies = Movie::paginate($limit,['*'],'page',$page);
        $count = $movies->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int','ID'],
            'title'=>['string','Tiêu đề'],
            'description' => ['text','Mô tả'],
            'thumbnail' => ['image','Hình nền'],
            'release_date' => ['date','Ngày chiếu'],
            'vote_count' => ['int','Lượt bình chọn'],
            'like_count' => ['int','Lượt thích']
        ];
        $values = $movies;
        $title = 'Phim';
        $for = 'movies';
        return view("data_manage.index",compact("movies","page",'types','values','title','count','for'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("genres.create");
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
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view("genres.show",compact("gen"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie,$id)
    {
        $gen = Genre::findOrFail($id);
        return view("genres.create",compact('gen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Movie $movie,$id)
    {
        $validated = $req->validate([
            "name" =>"required|string|max:255",
            "status"=>"integer|required"
        ]);
        $gen = Genre::findOrFail($id);

        $gen->update($validated);
        return redirect()->route("admin.genres.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie,$id)
    {
        $gen = Genre::find($id);
        $gen->delete();
        return redirect()->route('admin.genres.index');
    }
}
