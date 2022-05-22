@extends('/layout/layout')

@section('image')
    <div class="glitch__img glitch__img_register"></div>
    <div class="glitch__img glitch__img_register"></div>
    <div class="glitch__img glitch__img_register"></div>
    <div class="glitch__img glitch__img_register"></div>
    <div class="glitch__img glitch__img_register"></div>
@endsection

@section('navbar')
    <a href="{{ route('home.index') }}" class="p-3 text-decoration-none text-light bold">Home</a>
    <a href="{{ route('home.about') }}" class="p-3 text-decoration-none text-light bold">About</a>
    <a href="{{ route('home.hackerboard') }}" class="p-3 text-decoration-none text-light bold">Hackerboard</a>
    <a href="{{ route('user.login') }}" class="p-3 text-decoration-none text-light bold">Login</a>
    <a href="{{ route('user.register') }}" class="p-3 text-decoration-none text-white bold">Register</a>
@endsection

@section('content')
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-10">
                    <h1 class="display-1 bold color_white content__title">LAKSHYA CTF<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Join the community and be part of the future of the information security industry.
                    </p>
                    <div class="row  hackerFont">
                        <div class="col-md-6">
                            <form id="form_register" method="post" action="{{ route('user.add') }}">
                                @CSRF
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" placeholder="Your email">
                                    @error('email')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" placeholder="Your username">
                                    @error('username')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Your password">
                                    @error('password')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="re_password" placeholder="Re-type your password">
                                    @error('re_password')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                    <small id="passHelp" class="form-text text-muted">Make sure nobody's behind you</small>
                                </div>
                                <div class="custom-control custom-checkbox my-4">
                                    <input type="checkbox" class="custom-control-input" id="solemnly-swear">
                                    <label class="custom-control-label" for="solemnly-swear">I solemnly swear that I am up to no good.</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <button type="submit" id="regSend" class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-1 text-left typewriter" form="form_register" disabled>
                            <h4>Register</h4>
                    </button>
                    <small id="registerHelp" class="mt-2 form-text text-muted">Already Registered? <a href="{{ route('user.login') }}">Login here</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var checker = document.getElementById('solemnly-swear');
        var regBtn = document.getElementById('regSend');
        checker.onchange = function() {
            if(this.checked) {
                regBtn.disabled = false;
            } else {
                regBtn.disabled = true;
            }
        }
    </script>
@endsection