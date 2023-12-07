@extends('layouts.layout')
@section('title','Tạo Bình luận')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Bình luận</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($gen)?route('admin.comments.store'):route('admin.comments.update',$gen)}}" method="POST" enctype="multipart/form-data" class="sign__form sign__form--add">
                    @csrf
                    @if(!empty($gen))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="sign__group">
                                <h3 class="text-white" for="sign__movie">Phim</h3>
                                <select class="sign__selectjs" id="sign__movie" name="movie_id">
                                    
                                    @foreach ($movies as $movie)
                                        <option value="{{$movie->id}}" {{!empty($v) && $v->movie_id==$movie->id?'selected':''}}>{{$movie->title}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="sign__group">
                                <h3 class="text-white" for="sign__user">Người dùng</h3>
                                <select class="sign__selectjs" id="sign__user" name="user_id">
                                    
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{!empty($v) && $v->user_id==$user->id?'selected':''}}>{{$user->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="sign__group">
                            <input type="text" class="sign__input" placeholder="Nội dung*" name="content" value="{{!empty($v)?$v->content:''}}">
                        </div>
                       
                            <button type="submit" class="sign__btn sign__btn--small"><span>Lưu</span></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
@endsection
