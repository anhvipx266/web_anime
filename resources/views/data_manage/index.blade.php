@extends('layouts.layout')
@section('title', 'Danh sách ' . $title)
@section('main')
    <main class="main">

    </main>
    <div class="container-fluid">
        <a href="{{ route('admin.home') }}" class="header__logo">
            <img src="/img/logo.svg" alt="">
        </a>
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>{{$title}}</h2>

                    <span class="main__title-stat">Tổng cộng {{number_format($count)}}</span>

                    <div class="main__title-wrap">
                        

                        <!-- search -->
                        <form action="{{route('admin.'.$for.'.index')}}" class="main__title-wrap">
                            <input type="hidden" name="page" value="{{$page}}">
                            <select class="filter__select" name="order" id="filter__sort">
                                <option value="-1" {{$req->get('order') == '-1'?'selected':''}}>Mặc định</option>
                                <option value="0" {{$req->get('order') == '0'?'selected':''}}>Date created</option>
                                <option value="1" {{$req->get('order') == '1'?'selected':''}}>Rating</option>
                                <option value="2" {{$req->get('order') == '2'?'selected':''}}>Views</option>
                            </select>
                            <div class="main__title-form">
                                <input type="text" placeholder="{{$searchBy}}" name="search">
                                <button type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <!-- end search -->
                    </div>
                </div>
                <div>
                    <a class="text-white btn btn-white" href="{{ route('admin.'.$for.'.create') }}" >
                        Thêm mới
                    </a>
                </div>
            </div>
            <!-- end main title -->

            <!-- items -->
            <div class="col-12">
                <div class="catalog catalog--1">
                    <table class="catalog__table">
                        <thead>
                            <tr>
                                {{-- thiết lập các trường thông tin --}}
                                @foreach ($types as $key => $dtype)
                                    <th>{{ $dtype[1] }}</th>
                                @endforeach
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- thiết lập giá trị các cột dữ liệu --}}
                            @foreach ($values as $v)
                            <tr>
                                @foreach ($types as $key => $dtype)
                                    {{$type = $dtype[0]}}
                                    <td>
                                        @if ($type == 'string' || $type =='date')
                                            <div class="catalog__text">{{$v->$key}}</div>
                                        @elseif ($type == 'int' || $type =='float')
                                            <div class="catalog__text">{{number_format($v->$key)}}</div>
                                        @elseif($type == 'text')
                                            <div class="catalog__text">{{$v->$key}}</div>
                                        @elseif($type == 'image')
                                            <div class="catalog__text">
                                                <img height="160px" src="{{$v->$key}}" alt="{{ $key }}">
                                            </div>
                                        @elseif($type == 'link')
                                        <div class="catalog__text">
                                            <a href="">{{$v->$key}}</a>
                                        </div>
                                        @elseif($type == 'boolean')
                                        <div class="catalog__text">
                                            @if ($v->$key==1)
                                            ✅
                                            {{-- <i class="fa-solid fa-shield-check"></i> --}}
                                            @else
                                            ❌
                                            {{-- <i class="fa-solid fa-circle-xmark"></i> --}}
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                @endforeach
                                {{-- hành động --}}
                                <td>
                                    <div class="catalog__btns">
                                        <button type="button" data-bs-toggle="modal"
                                            class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12,13a1,1,0,0,0-1,1v3a1,1,0,0,0,2,0V14A1,1,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z" />
                                            </svg>
                                        </button>
                                        <a href="#" class="catalog__btn catalog__btn--view">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.'.$for.'.edit', $v) }}"
                                            class="catalog__btn catalog__btn--edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z" />
                                            </svg>
                                        </a>
                                        {{-- <form action="{{ route('admin.'.$for.'.destroy', $v) }}" method="POST"> --}}
                                            {{-- @csrf --}}
                                            {{-- @method('delete') --}}
                                            <button type="button" data-bs-toggle="modal"
                                                class="catalog__btn catalog__btn--delete"
                                                data-bs-target="#modal-delete"
                                                onclick="selectDelete(this)" ID = '{{$v->id}}' action = '{{ route('admin.'.$for.'.destroy', $v) }}'>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Z" />
                                                </svg>
                                            </button>
                                        {{-- </form> --}}
                                    </div>
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end items -->

            <!-- paginator -->
            <div class="col-12">
                <div class="main__paginator">
                    <!-- amount -->
                    <span class="main__paginator-pages">{{ $values->currentPage() . '/' . $values->total() }}</span>
                    <!-- end amount -->

                    <ul class="main__paginator-list">
                        <li>
                            <a href="{{ 0 }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z" />
                                </svg>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $values->previousPageUrl() }}">
                                <span>Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z" />
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <ul class="paginator">
                        @if (!empty($values->previousPageUrl()))
                            <li class="paginator__item paginator__item--prev">
                                <a href="{{ $values->previousPageUrl() }}"><svg xmlns="http://www.w3.org/2000/svg"
                                        enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                        <path
                                            d="M8.5,12.8l5.7,5.6c0.4,0.4,1,0.4,1.4,0c0,0,0,0,0,0c0.4-0.4,0.4-1,0-1.4l-4.9-5l4.9-5c0.4-0.4,0.4-1,0-1.4c-0.2-0.2-0.4-0.3-0.7-0.3c-0.3,0-0.5,0.1-0.7,0.3l-5.7,5.6C8.1,11.7,8.1,12.3,8.5,12.8C8.5,12.7,8.5,12.7,8.5,12.8z" />
                                    </svg></a>
                            </li>
                        @endif
                        @for ($i = $page - 2; $i <= $page + 2; $i++)
                            @if ($i < 1 || $i > $values->total())
                                @continue
                            @endif
                            <li class="paginator__item {{ $i == $values->currentPage() ? 'paginator__item--active' : '' }}"><a
                                    href="{{ $values->url($i) }}">{{ $i }}</a></li>
                        @endfor


                        @if (!empty($values->nextPageUrl()))
                            <li class="paginator__item paginator__item--next">
                                <a href="{{ $values->nextPageUrl() }}"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M15.54,11.29,9.88,5.64a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l4.95,5L8.46,17a1,1,0,0,0,0,1.41,1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l5.66-5.65A1,1,0,0,0,15.54,11.29Z" />
                                    </svg></a>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>

            <!-- end paginator -->
        </div>
    </div>
@endsection

@section('last-components')
    <!-- status modal -->
    <div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modal-status" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal__content">
                    <form action="#" class="modal__form">
                        <h4 class="modal__title">Status change</h4>

                        <p class="modal__text">Are you sure about immediately change status?</p>

                        <div class="modal__btns">
                            <button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
                            <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
                                aria-label="Close"><span>Dismiss</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end status modal -->

    <!-- delete modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal__content">
                    <form action="" class="modal__form" id="deleteForm">
                        @csrf
                        @method('delete')
                        <h4 class="modal__title">Xóa mục</h4>

                        <p class="modal__text" id="deletePromptNote"></p>

                        <div class="modal__btns">
                            <button class="modal__btn modal__btn--apply" type="button" onclick="deleteItem()"><span>Delete</span></button>
                            <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal"
                                aria-label="Close"><span>Dismiss</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end delete modal -->
@endsection


@section('js')
    <script>
        function selectDelete(btn){
            // console.log(this);
            // console.log(btn);
            // cập nhật thông tin modal
            var id = btn.getAttribute('ID')
            deletePromptNote.innerHTML = `Bạn có chắc muốn xóa mục ${id}?`
            deleteForm.setAttribute('action',btn.getAttribute('action'))
            
        }
        function deleteItem(){
            var action = deleteForm.getAttribute('action')
            var formData = new FormData(deleteForm)
            // tạo và gửi một form 
            var xhttp = new XMLHttpRequest()
            xhttp.open('POST',action,true)
            xhttp.onload = function(){
                if (xhttp.status == 200) {
                    // Xử lý phản hồi từ server nếu cần
                    // console.log(xhr.responseText);
                    // tải lại trang
                    location.reload();
                }
            }
            xhttp.send(formData)
        }
    </script>
@endsection