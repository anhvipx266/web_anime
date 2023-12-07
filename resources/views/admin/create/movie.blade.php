@extends('layouts.layout')
@section('title','Tạo Phim')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Phim</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($gen)?route('admin.movies.store'):route('admin.movies.update',$gen)}}" method="POST" enctype="multipart/form-data" class="sign__form sign__form--add">
                    @csrf
                    @if(!empty($gen))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Tiêu đề*" name="title" value="{{!empty($v)?$v->title:''}}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả">{{!empty($v)? $v->description :''}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <div class="sign__group col-6">
                                            <input type="url" class="sign__input" placeholder="Link Hình Nền*" name="thumbnail" value="{{!empty($v)? $v->thumbnail :''}}">
                                        </div>
                                        <div class="sign__image sign__gallery col-6">
                                            <label id="" for="sign__gallery-upload">Upload cover
                                                (240x340)</label>
                                            <input data-name="" id="sign__gallery-upload" name="thumbnail_file"
                                                class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg"
                                                >
                                            </div>
                                        <div class="row">
                                            <img id="avatar-preview" src="{{!empty($v)? $v->thumbnail :''}}" alt="Preview" style="display: none; max-width: 300px; height:160px;">
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                        <div class="col-12 col-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <h4 class="text-white" for="sign__movie">Series</h4>
                                        <select class="sign__selectjs" id="sign__series" name="series_id">
                                            
                                            @foreach ($series as $se)
                                                <option value="{{$se->id}}" {{!empty($v) && $v->series_id==$se->id ? 'selected' :''}}>{{$se->title}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="sign__group">
                                        <h4 class="text-white" for="sign__country">Quốc gia</h4>
                                        <select class="sign__selectjs" id="sign__country" name="country_id">
                                            @foreach ($countries as $con)
                                                <option value="{{$con->id}}" {{!empty($v) && $v->country_id==$con->id ? 'selected' :''}}>{{$con->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sign__group">
                                        <h4 class="text-white" >Thể loại</h4>
                                        <select class="sign__selectjs" id="sign__genre">
                                            @foreach ($genres as $gen)
                                                <option value="{{$gen->id}}" {{!empty($v) && $v->genre_id==$gen->id ? 'selected' :''}}>{{$gen->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
                                            <h4 class="text-white" for="sign__country">Tác giả, Đạo diễn</h4>
                                            <select class="sign__selectjs" id="sign__director" name="author_id">
                                                @foreach ($authors as $au)
                                                    <option value="{{$au->id}}" {{!empty($v) && $v->author_id==$au->id ? 'selected' :''}}>{{$au->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
