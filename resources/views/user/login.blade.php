@extends('/layout/layout')

@section('image')
    <div class="glitch__img"></div>
    <div class="glitch__img"></div>
    <div class="glitch__img"></div>
    <div class="glitch__img"></div>
    <div class="glitch__img"></div>
@endsection

@section('navbar')
    <a href="{{ route('home.index') }}" class="p-3 text-decoration-none text-light bold">Home</a>
    <a href="{{ route('home.about') }}" class="p-3 text-decoration-none text-light bold">About</a>
    <a href="{{ route('home.hackerboard') }}" class="p-3 text-decoration-none text-light bold">Hackerboard</a>
    <a href="{{ route('user.login') }}" class="p-3 text-decoration-none text-white bold">Login</a>
    <a href="{{ route('user.register') }}" class="p-3 text-decoration-none text-light bold">Register</a>
@endsection

@section('content')
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="display-1 bold color_white content__title">LAKSHYA CTF<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Type your credentials to conquer the world
                    </p>
                    <div class="row hackerFont">
                        <div class="col-md-6">
                            <form id="login" method="post" action="{{-- route('user.auth') --}}">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" placeholder="Your email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                    <small id="passHelp" class="form-text text-muted">Make sure nobody's behind you</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <button type="submit" class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-1 text-left typewriter" form="login">
                    <h4>Login</h4>
                    </button>
                    <small id="registerHelp" class="mt-3 form-text text-muted">Not Registered? <a href="{{ route('user.register') }}">Register here</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection