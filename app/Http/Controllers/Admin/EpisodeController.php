<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;
use Storage;

class EpisodeController extends Controller
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
        $episodes = Episode::getDetails()
            ->paginate($limit, ['*'], 'page', $page);
        $count = $episodes->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'movie' => ['string', 'Phim'],
            'title' => ['string', 'Tiêu đề'],
            'thumbnail' => ['image', 'Hình nền'],
            'like_count' => ['int', 'Lượt thích'],
            'release_date' => ['date', 'Công chiếu'],
        ];
        $values = $episodes;
        $title = 'Tập phim';
        $for = 'episodes';
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
        $movies = Movie::all();
        return view('admin.create.episode',compact('movies'));
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
            'movie_id' => 'integer|required',
            'thumbnail'=>'string',
            'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        // tải file thế link
        if ($req->hasFile('thumbnail_file')) {
            $avatar = $req->file('thumbnail_file');
            
            $path = $avatar->store('public/imgs/images');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['thumbnail'] = Storage::url($path);
        }
        Episode::create($validated);
        return redirect()->route('admin.episodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        $movies = Movie::all();
        $v = $episode;
        return view('admin.create.episode',compact('movies','v'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Episode $episode)
    {
         // dd($req->all());
         $validated = $req->validate([
            'title'=>'string|required|max:255',
            'movie_id' => 'integer|required',
            'thumbnail'=>'string',
            'thumbnail_file'=>'file|mimes:jpg,jpeg,png,gif|max:10000'
        ],[
            
        ]);
        // tải file thế link
        if ($req->hasFile('thumbnail_file')) {
            $avatar = $req->file('thumbnail_file');
            
            $path = $avatar->store('public/imgs/images');
            
            // Lưu đường dẫn vào database hoặc thực hiện các thao tác khác tùy ý
            $validated['thumbnail'] = Storage::url($path);
        }
        $episode->update($validated);
        return redirect()->route('admin.episodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
    }
}
