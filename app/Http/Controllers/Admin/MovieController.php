<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Series;
use Illuminate\Http\Request;
use Storage;

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
        $series = Series::all();
        $authors = Author::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view("admin.create.movie",compact(
            'series','authors','countries','genres'
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
            'title'=>'string|required|max:255',
            'author_id' => 'integer|required',
            'country_id' => 'integer|required',
            // 'release_date'=>'date'
            'thumbnail'=>'string',
            'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        // dd(1);
        // tải file thế link
        if ($req->hasFile('thumbnail_file')) {
            $avatar = $req->file('thumbnail_file');
            
            $path = $avatar->store('public/imgs/images');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['thumbnail'] = Storage::url($path);
        }
        Movie::create($validated);
        return redirect()->route('admin.movies.index');
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
    public function edit(Movie $movie)
    {
       
        return view("genres.create",[
            'v'=>$movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Movie $movie)
    {
       // dd($req->all());
       $validated = $req->validate([
        'title'=>'string|required|max:255',
        'author_id' => 'integer|required',
        'country_id' => 'integer|required',
        // 'release_date'=>'date'
        'thumbnail'=>'string',
        'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
    ],[
        
    ]);
    // dd(1);
    // tải file thế link
    if ($req->hasFile('thumbnail_file')) {
        $avatar = $req->file('thumbnail_file');
        
        $path = $avatar->store('public/imgs/images');
        
        // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
        $validated['thumbnail'] = Storage::url($path);
    }
    $movie->update($validated);
    return redirect()->route('admin.movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
}
