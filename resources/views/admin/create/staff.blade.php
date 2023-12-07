@extends('layouts.layout')
@section('title','Tạo Nhân viên')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm Nhân viên</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{empty($gen)?route('admin.staffs.store'):route('admin.staffs.update',$gen)}}" method="POST" enctype="multipart/form-data" class="sign__form sign__form--add">
                    @csrf
                    @if(!empty($gen))
                        @method('patch')
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Tên*" name="name" value="{{!empty($v)?$v->name:''}}">
                                    </div>
                                    div class="sign__group">
                                        <input type="email" class="sign__input" placeholder="Email*" name="email" value="{{!empty($v)?$v->email:''}}">
                                    </div>
                                    div class="sign__group">
                                    <input type="password" class="sign__input" placeholder="Password*" name="password" value="{{!empty($v)?$v->password:''}}">
                                </div>
                                    div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Phone*" name="phone" value="{{!empty($v)?$v->phone:''}}">
                                    </div>
                                    div class="sign__group">
                                        <input type="text" class="sign__input" placeholder="Địa chỉ" name="address" value="{{!empty($v)?$v->address:''}}">
                                    </div>
                                    <div class="sign__group">
                                        <div class="sign__group col-6">
                                            <input type="url" class="sign__input" placeholder="Link Avatar*" name="avatar" value="{{!empty($v)?$v->avatar:''}}">
                                        </div>
                                        <div class="sign__image sign__gallery col-6">
                                            <label id="" for="sign__gallery-upload">Upload cover
                                                (240x340)</label>
                                            <input data-name="" id="sign__gallery-upload" name="avatar_file"
                                                class="sign__gallery-upload" type="file" accept=".png, .jpg, .jpeg"
                                                >
                                            </div>
                                        <div class="row">
                                            <img id="avatar-preview" src="{{!empty($v)?$v->avatar:''}}" alt="Preview" style="display: none; max-width: 300px; height:160px;">
                                        </div>
                                    </div>
                                    <div class="sign__group">
                                        <label class="sign__label">Giới tính*</label>
                                        <ul class="sign__radio">
                                            <li>
                                                <input id="type1" type="radio" name="gender" data-bs-toggle="collapse"
                                                    data-bs-target=".multi-collapse" {{!empty($v) && $v->gender==1?'checked':''}} value="1">
                                                <label for="type1">Nam</label>
                                            </li>
                                            <li>
                                                <input id="type2" type="radio" name="gender" {{!empty($v) && $v->gender==0?'checked':''}} value ="0" data-bs-toggle="collapse"
                                                    data-bs-target=".multi-collapse">
                                                <label for="type2">Nữ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sign__group">
                                        <label class="sign__label">Trạng thái*</label>
                                        <ul class="sign__radio">
                                            <li>
                                                <input id="type1" type="radio" {{!empty($v) && $v->status==1?'checked':''}} name="status" data-bs-toggle="collapse"
                                                    data-bs-target=".multi-collapse" checked value="1">
                                                <label for="type1">Hiện</label>
                                            </li>
                                            <li>
                                                <input id="type2" type="radio" name="status" {{!empty($v) && $v->status==0?'checked':''}} value ="0" data-bs-toggle="collapse"
                                                    data-bs-target=".multi-collapse">
                                                <label for="type2">Ẩn</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sign__group">
                                        <h4 class="text-white" for="sign__country">Vai trò</h4>
                                        <select class="sign__selectjs" id="sign__country" name="staff_roles">
                                            @foreach ($staff_roles as $role)
                                                <option value="{{$role->id}}" {{!empty($v) && $v->staff_roles== $role->id?'selected':''}}>{{$role->role}}</option>
                                            @endforeach
                                        </select>
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
