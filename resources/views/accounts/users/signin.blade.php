@extends('layouts.layout')

@section('main')
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="{{route('accounts.login')}}" method="POST" class="sign__form">
                            @csrf
                            <a href="{{route('home')}}" class="sign__logo">
                                <img src="img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Email" name="email">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Password" name="password">
                            </div>
                           

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">Remember Me</label>
                            </div>

                            <button class="sign__btn" type="submit"><span>Sign in</span></button>

                            <span class="sign__text">Don't have an account? <a href="{{route('accounts.signup')}}">Sign up!</a></span>

                            <span class="sign__text"><a href="/forgot">Forgot password?</a></span>
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
