@extends('/layout/layout')

@section('meta')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endsection

@section('body_class')
    <body class="imgloaded">
@endsection

@section('image')
    <div class="glitch">
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
    </div>
@endsection

@section('content')
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">PROFILE: </span>{{ $username }}<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        In life the loser's score is always zero
                    </p>
                    <div class="row justify-content-center my-5">
                        <div class="col-xl-10">
                            <h4 class="bold color_white pt-3" style="text-align: center">
                                Score: {{ $totalScore }} points - Rank: {{ $str_rank }} place
                            </h4>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>#</th>
                                <th>Challenge</th>
                                <th>Category</th>
                                <th>Score</th>
                                <th>Validated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solves as $solve)
                                <tr>
                                    <th scope="row">{{ $index++ }}</th>
                                    <td>{{ $solve->name }}</td>
                                    @switch($solve->category)
                                        @case('web')
                                            <td>Web Exploitation</td>
                                            @break
                                        @case('web')
                                            <td>Binary Exploitation</td>
                                            @break
                                        @case('rev')
                                            <td>Reverse Engineering</td>
                                            @break
                                        @case('frs')
                                            <td>Forensics</td>
                                    @endswitch
                                    <td>{{ $solve->score }}</td>
                                    <td>{{ $solve->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

    <script>
        var xValues = ["Web Exploitation", "Binary Exploitation", "Reverse Engineering", "Forensics"];
        var yValues = {{ Js::from($scores) }};
        var barColors = [
        // "#b91d47",
        // "#00aba9",
        // "#2b5797",
        // "#e8c3b9"
            "#ef121b94",
            "#f9751594",
            "#17b06b94",
            "#36a2eb94"
        ];

        new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            borderColor: 'black',
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            }
        }
        });
    </script>
@endsection