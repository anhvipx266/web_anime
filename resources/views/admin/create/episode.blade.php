@extends('layouts.layout')
@section('title','Tạo Tập Phim')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Tập Phim</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($gen)?route('admin.episodes.store'):route('admin.episodes.update',$gen)}}" method="POST" enctype="multipart/form-data" class="sign__form sign__form--add">
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
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Tiêu đề*" name="title" value="{{!empty($v)?$v->title:''}}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <div class="sign__group col-6">
                                            <input type="url" class="sign__input" placeholder="Link Hình Nền*" name="thumbnail" value="{{!empty($v)?$v->thumbnail:''}}">
                                        </div>
                                        <div class="sign__image sign__gallery col-6">
                                            <label id="" for="sign__gallery-upload">Upload cover
                                                (240x340)</label>
                                            <input data-name="" id="sign__gallery-upload" name="thumbnail_file"
                                                class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg"
                                                >
                                            </div>
                                        <div class="row">
                                            <img id="avatar-preview" src="{{!empty($v)?$v->thumbnail:''}}" alt="Preview" style="display: none; max-width: 300px; height:160px;">
                                        </div>
                                    </div>
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
