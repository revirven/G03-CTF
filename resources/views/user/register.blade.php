@extends('/layout/layout')

@section('body_class')
    <body class="imgloaded">
@endsection

@section('image')
    <div class="glitch">
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
    </div>
@endsection

@section('content')
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-10">
                    <h1 class="display-1 bold color_white content__title">REGISTER<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Join the community and be part of the future of the information security industry.
                    </p>
                    <div class="row  hackerFont">
                        <div class="col-md-6">
                            <form id="form_register" method="post" action="{{ route('user.add') }}">
                                @CSRF
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    @error('email')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                    @error('username')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    @error('password')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="re_password" placeholder="Re-type your password">
                                    @error('re_password')
                                        <p class="text-danger"><strong>{{ $message }}</strong></p>
                                    @enderror
                                    <small id="passHelp" class="form-text text-muted">Make sure nobody's behind you</small>
                                </div>
                            </form>
                                <div class="custom-control custom-checkbox my-4">
                                    <input type="checkbox" class="custom-control-input" id="solemnly-swear">
                                    <label class="custom-control-label" for="solemnly-swear">I solemnly swear that I am up to no good.</label>
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
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