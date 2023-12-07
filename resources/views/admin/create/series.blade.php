@extends('layouts.layout')
@section('title','Tạo Loại phim')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Series</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($gen)?route('admin.series.store'):route('admin.series.update',$gen)}}" method="POST" enctype="multipart/form-data" class="sign__form sign__form--add">
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
                                        <textarea id="text" name="description" class="sign__textarea" placeholder="Mô tả">{{!empty($v)?$v->description:''}}</textarea>
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
