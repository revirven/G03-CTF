@extends('/layout/layout')

@section('meta')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endsection

@section('body_class')
    <body>
@endsection

@section('content')
    <div class="jumbotron bg-transparent mb-0 pt-0 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12  text-center">
                    <h1 class="display-1 bold color_white content__title">CHALLENGES<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Its time to show the world what you can do!
                    </p>
                </div>
            </div>
            <div class="row hackerFont">
                <div class="col-md-12">
                    <h4>Challenges</h4>
                </div>
                @foreach($challenges as $chall)
                    <div class="col-md-12 mb-3">
                        @switch($chall->category)
                            @case('web')
                                <div class="card category_web">
                                @break
                            @case('pwn')
                                <div class="card category_pwning">
                                @break
                            @case('rev')
                                <div class="card category_reversing">
                                @break
                            @case('frs')
                                <div class="card category_forensics">
                        @endswitch
                        @if(in_array($chall->id, $solved))
                            <div id="header_{{ $chall->id }}" class="solved card-header" data-target="#problem_id_{{ $chall->id }}" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_{{ $chall->id }}">
                                {{ $chall->name }} <span class="badge align-self-end">{{ $chall->score }} points</span>
                            </div>
                        @else
                            <div id="header_{{ $chall->id }}" class="card-header" data-target="#problem_id_{{ $chall->id }}" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_{{ $chall->id }}">
                                {{ $chall->name }} <span class="badge align-self-end">{{ $chall->score }} points</span>
                            </div>
                        @endif
                        @if(isset($msg) && $chall->id === $msg['chall_id'])
                            <div id="problem_id_{{ $chall->id }}" class="collapse show card-body">
                        @else
                            <div id="problem_id_{{ $chall->id }}" class="collapse card-body">
                        @endif
                                <blockquote class="card-blockquote">
                                    <div style="display: flex;">
                                        <h6 class="solvers">Solvers: <span class="solver_num">76</span> &nbsp</h6>
                                    </div>
                                    <p> {{ $chall->descript }} </p>
                                    @if(!is_null($chall->file))
                                        <a target="_blank" href="{{ route('chall.download', 1) }}" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-download mr-2"></span>Download</a>
                                    @endif
                                    @if(!is_null($chall->hint))
                                        <a href="#hint_{{ $chall->id }}" data-toggle="modal" data-target="#hint_{{ $chall->id }}" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>
                                    @endif
                                    <br><br>
                                    <div class="input-group mt-3">
                                        <form id="chall_submit_{{ $chall->id }}" method="post", action="{{ route('chall.submit') }}">
                                            @CSRF
                                            @method('put')
                                            <input type="text" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag">
                                            <input type="hidden" name="challenge_id" value="{{ $chall->id }}">
                                        </form>
                                        <div class="input-group-append">
                                            <button id="submit_p6" class="btn btn-outline-secondary" type="submit" form="chall_submit_{{ $chall->id }}">Submit</button>
                                        </div>
                                    </div>
                                </blockquote>
                                @if(isset($msg) && $chall->id === $msg['chall_id'])
                                    @if ($msg['validated'])
                                        <div id="alert_{{ $chall->id }}" class="alert alert-success alert-dismissible fade show" role="alert">
                                    @else
                                        <div id="alert_{{ $chall->id }}" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @endif
                                        {{ $msg['note'] }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="hint_{{ $chall->id }}" tabindex="-1" role="dialog" aria-labelledby="hint label" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    {{ $chall->hint }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row hackerFont justify-content-center mt-5">
                <div class="col-md-12">
                    <br><br>Challenge Types:
                    <span class="p-1" style="background-color:#ef121b94">Web Exploitation</span>
                    <span class="p-1" style="background-color:#f9751594">Binary Exploitation</span>
                    <span class="p-1" style="background-color:#17b06b94">Reverse Engineering</span>
                    <span class="p-1" style="background-color:#36a2eb94">Forensics</span>
                </div>
            </div>
        </div>
@endsection

@section('script')
        <script>
            var dataset = [
                [41, 42, 43, 44, 45, 0], // keep the zero here
                [10, 9, 8, 7, 6, 0],
                [21, 16, 23, 1, 15, 0],
                [71, 12, 13, 17, 25, 0],
                [31, 5, 23, 24, 10, 0],
                [11, 2, 13, 41, 15, 0],
                [31, 5, 23, 24, 10, 0],
                [11, 2, 13, 41, 15, 0],
            ]

            function getBarChartData(i) {
                return barChartData = {
                    labels: ['Easy1', 'Easy2', 'Medium3', 'Hard4', 'Hard5'],
                    datasets: [{
                        label: 'Dataset 1',
                        backgroundColor: [
                            '#17b06b', '#17b06b', '#ffce56', '#ef121b', '#ef121b'
                        ],
                        borderColor: [
                            '#17b06b', '#17b06b', '#ffce56', '#ef121b', '#ef121b'
                        ],
                        borderWidth: 1,
                        data: dataset[i - 1]
                    }]

                };
            }

            window.onload = function() {
                var numcharts = 8;
                for (let i = 1; i <= numcharts; i++) {
                    var ctx = document.getElementById('problem_id_' + i + '_chart').getContext('2d');
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: getBarChartData(i),
                        options: {
                            tooltips: {
                                enabled: false,
                            },
                            responsive: false,
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    display: false
                                }],
                                xAxes: [{
                                    display: false
                                }]
                            }
                        }
                    });
                    myBar.canvas.parentNode.style.width = '80px';
                    myBar.canvas.parentNode.style.height = '20px';
                }
            };
        </script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection