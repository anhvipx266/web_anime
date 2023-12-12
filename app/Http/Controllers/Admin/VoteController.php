<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Http\Request;

class VoteController extends Controller
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
        
        $votes = Vote::search($req)
            ->paginate($limit, ['*'], 'page', $page);
        $count = $votes->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'user' => ['string', 'Tác giả'],
            'movie' => ['string', 'Phim']
        ];
        $values = $votes;
        $title = 'Bình chọn';
        $for = 'votes';
        $searchBy = 'Tìm theo người dùng';
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
        $users = User::all();
        $movies = Movie::all();
        return view('admin.create.vote',compact(
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
        ],[
            
        ]);
        
        Vote::create($validated);
        return redirect()->route('admin.votes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        $users = User::all();
        $movies = Movie::all();
        $v = $vote;
        return view('admin.create.vote',compact(
            'users','movies','v'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Vote $vote)
    {
         // dd($req->all());
         $validated = $req->validate([
            'user_id'=>'integer|required',
            'movie_id' => 'integer|required',
        ],[
            
        ]);
        
       $vote->update($validated);
        return redirect()->route('admin.votes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();
    }
}
