@extends('layouts.layout')

@section('title','Tạo Thể loại')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('admin.home') }}" class="header__logo">
                <img src="/img/logo.svg" alt="">
            </a>
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Thể loại</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($v)?route('admin.genres.store'):route('admin.genres.update',$v)}}" method="POST" class="sign__form sign__form--add" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($v))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Thể loại*" name="name" value="{{!empty($v)?$v->name:''}}">
                                    </div>
                                </div>

                
                            </div>
                            <div class="sign__group">
                                <label class="sign__label">Trạng thái</label>
                                <ul class="sign__radio">
                                    <li>
                                        <input id="type1" type="radio" name="status" data-bs-toggle="collapse"
                                            data-bs-target=".multi-collapse" {{!empty($v) && $v->status==1 ? 'checked' :''}} value="1">
                                        <label for="type1">Hiện</label>
                                    </li>
                                    <li>
                                        <input id="type2" type="radio" name="status" {{!empty($v) && $v->status==0 ? 'checked' :''}} value ="0" data-bs-toggle="collapse"
                                            data-bs-target=".multi-collapse">
                                        <label for="type2">Ẩn</label>
                                    </li>
                                </ul>
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
