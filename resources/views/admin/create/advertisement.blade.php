@extends('layouts.layout')

@section('title','Tạo Quảng cáo')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('admin.home') }}" class="header__logo">
                <img src="/img/logo.svg" alt="">
            </a>
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Quảng cáo</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($v)?route('admin.advertisements.store'):route('admin.advertisements.update',$v)}}" method="POST" class="sign__form sign__form--add" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($v))
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
                                        <textarea id="text" name="description" id="description" class="sign__textarea" placeholder="Mô tả" value =''>{{!empty($v)?$v->description:''}}</textarea>
                                    </div>
                                </div>

                                

                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="url" class="sign__input" name="target_url" placeholder="Mục tiêu tới*" value="{{!empty($v)?$v->target_url:''}}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <div class="sign__group col-6">
                                            <input type="url" class="sign__input" placeholder="Link Hình Nền" name="image_url" value="{{!empty($v)?$v->image_url:''}}">
                                        </div>
                                        <div class="sign__image sign__gallery col-6">
                                            <label id="" for="sign__gallery-upload">Upload cover
                                                (240x340)</label>
                                            <input data-name="" id="sign__gallery-upload" name="image_file"
                                                class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg"
                                                >
                                            </div>
                                        <div class="row">
                                            <img id="avatar-preview" src="{{!empty($v)?$v->image_url:''}}" alt="Preview" style="display: none; max-width: 300px; height:160px;">
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
