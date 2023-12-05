@extends('layouts.layout')

@section('main')
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="{{route('accounts.register')}}" method="POST" class="sign__form">
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
