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
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">SCORE</span>BOARD<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        In life the loser's score is always zero
                    </p>
                    <div class="row justify-content-center my-5">
                        <div class="col-xl-10">
                            <h4 class="bold color_white pt-3" style="text-align: center">
                                Score: 5640 points - Rank: 10th place
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
                                <th>Total Time Taken</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Challenge 2.1 - dump.raw</td>
                                <td>Forensics</td>
                                <td>42:59</td>
                                <td>2540</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Challenge 2.2 - dump.raw</td>
                                <td>Forensics</td>
                                <td>44:59</td>
                                <td>1900</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Challenge 2.3 - dump.raw</td>
                                <td>Forensics</td>
                                <td>40:00</td>
                                <td>650</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Challenge 1 - memory.dmp</td>
                                <td>Forensics</td>
                                <td>40:10</td>
                                <td>550</td>
                            </tr>
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
        var xValues = ["Challenge 2.1", "Challenge 2.2", "Challenge 2.3", "Challenge 1"];
        var yValues = [2540, 1900, 650, 550];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9"
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