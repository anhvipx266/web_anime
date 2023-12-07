<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
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
        $likes = Like::getDetails()
            ->paginate($limit, ['*'], 'page', $page);
        $count = $likes->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'user' => ['string', 'Tác giả'],
            'movie' => ['string', 'Phim'],
            'is_like' => ['boolean', 'Thích'],
        ];
        $values = $likes;
        $title = 'Lượt thích';
        $for = 'likes';
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
        $users = User::all();
        $movies = Movie::all();
        return view('admin.create.like',compact(
            'users','movies'
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
            'user_id'=>'integer|required',
            'movie_id' => 'integer|required',
            'is_like'=>'integer|required',
            'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        
        Like::create($validated);
        return redirect()->route('admin.episodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        $users = User::all();
        $movies = Movie::all();
        $v = $like;
        return view('admin.create.like',compact(
            'users','movies'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Like $like)
    {
        // dd($req->all());
        $validated = $req->validate([
            'user_id'=>'integer|required',
            'movie_id' => 'integer|required',
            'is_like'=>'integer|required',
            'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        
       $like->update($validated);
        return redirect()->route('admin.episodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        $like->delete();
    }
}
