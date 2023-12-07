@extends('layouts.layout')

@section('title','Tạo Bình chọn')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('admin.home') }}" class="header__logo">
                <img src="/img/logo.svg" alt="">
            </a>
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Bình chọn</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($v)?route('admin.votes.store'):route('admin.votes.update',$v)}}" method="POST" class="sign__form sign__form--add" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($v))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="sign__group">
                                <h4 class="text-white" for="sign__movie">Người dùng</h4>
                                <select class="sign__selectjs" id="sign__user" name="user_id">
                                    
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{!empty($v) && $v->user_id==$user->id?'selected':''}}>{{$user->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="sign__group">
                                <h4 class="text-white" for="sign__movie">Phim</h4>
                                <select class="sign__selectjs" id="sign__movie" name="movie_id">
                                    
                                    @foreach ($movies as $movie)
                                        <option value="{{$movie->id}}" {{!empty($v) && $v->movie_id==$movie->id?'selected':''}}>{{$movie->title}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="sign__btn sign__btn--small"><span>Lưu</span></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
@endsection
