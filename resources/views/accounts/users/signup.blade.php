@extends('layouts.layout')

@section('main')
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="{{route('accounts.register')}}" method="POST" class="sign__form" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <a href="{{route('home')}}" class="sign__logo">
                                <img src="img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Name" name="name">
                            </div>

                            <div class="sign__group">
                                <input type="email" class="sign__input" placeholder="Email" name="email">
                            </div>

                            <div class="sign__group">
                                <input type="file" id="iavatar" class="sign__input" placeholder="Avatar" name="avatar" accept="image/*" onchange="previewImage()">
                                <br>
                                <img id="avatar-preview" src="#" alt="Preview" style="display: none; max-width: 300px;">
                            </div>

                            <div class="sign__group">
                                <label class="sign__label">Giới tính*</label>
                                <ul class="sign__radio">
                                    <li>
                                        <input id="type1" type="radio" name="gender" data-bs-toggle="collapse"
                                            data-bs-target=".multi-collapse" checked value="1">
                                        <label for="type1">Nam</label>
                                    </li>
                                    <li>
                                        <input id="type2" type="radio" name="gender" value ="0" data-bs-toggle="collapse"
                                            data-bs-target=".multi-collapse">
                                        <label for="type2">Nữ</label>
                                    </li>
                                </ul>
                            </div>
                        
                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Password" name="password">
                            </div>
                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Confirm Password" name="confirm-password">
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">I agree to the <a href="#">Privacy Policy</a></label>
                            </div>

                            <button class="sign__btn" type="submit"><span>Sign up</span></button>

                            <span class="sign__text">Already have an account? <a href="{{route('accounts.signin')}}">Sign in!</a></span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
    function previewImage() {
        var input = document.getElementById('iavatar');
        var preview = document.getElementById('avatar-preview');
        console.log('avatar input change!')
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection