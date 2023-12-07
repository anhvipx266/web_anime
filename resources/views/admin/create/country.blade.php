@extends('layouts.layout')

@section('title','Tạo Quốc gia')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('admin.home') }}" class="header__logo">
                <img src="/img/logo.svg" alt="">
            </a>
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Quốc Gia</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($v)?route('admin.countries.store'):route('admin.countries.update',$v)}}" method="POST" class="sign__form sign__form--add" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($v))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Tên quốc gia*" name="name" value="{{!empty($v)?$v->name:''}}">
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
