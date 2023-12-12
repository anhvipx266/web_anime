<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
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
       
        $comments = Comment::search($req)
            ->paginate($limit, ['*'], 'page', $page);
        // dd($comments);
        $count = $comments->count();
        // key => 
        //          form type
        //          show text
        $types = [
            'id' => ['int', 'ID'],
            'user' => ['string', 'Tác giả'],
            'movie' => ['string', 'Phim'],
            'content' => ['string', 'Nội dung'],
        ];
        $values = $comments;
        $title = 'Bình luận';
        $for = 'comments';
        $searchBy = 'Tìm theo tên người dùng...';
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
        return view('admin.create.comment',compact(
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
            'content'=>'string|required|max:255'
        ],[
            
        ]);
      
        Comment::create($validated);
        return redirect()->route('admin.comments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $users = User::all();
        $movies = Movie::all();
        $v = $comment;
        return view('admin.create.comment',compact(
            'users','movies','v'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Comment $comment)
    {
         // dd($req->all());
         $validated = $req->validate([
            'user_id'=>'integer|required',
            'movie_id' => 'integer|required',
            'content'=>'string|required|max:255'
        ],[
            
        ]);
      
        $comment->update($validated);
        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
