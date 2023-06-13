<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Transaksi</title>
        <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       <!-- Fontawesome CSS -->
</head>
<body>

    @if (Auth::user()->hasRole('admin'))

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Toko Kaca Ameng</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('product.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
              </li>
          </ul>
        </div>
      </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.dashboard.filter') }}" method="get">
                    @csrf
                    @php
                        $months = [
                            'January' => '01',
                            'February' => '02',
                            'March' => '03',
                            'April' => '04',
                            'May' => '05',
                            'June' => '06',
                            'July' => '07',
                            'August' => '08',
                            'September' => '09',
                            'October' => '10',
                            'November' => '11',
                            'December' => '12'
                        ];
                    @endphp
                    <select name="months" id="months">
                        @foreach ($months as $month => $month_value)
                            <option value="{{ $month_value }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <select name="years" id="years">
                        @for ($year = date('Y') ; $year >= 2015 ; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <button type="submit">Search</button>
                </form>
                <form action="{{ route('admin.dashboard') }}">
                    <button type="submit">Reset</button>
                </form>
                <div class="panel panel-default">
                    <div class="panel-heading my-2">Data Transaksi</div>
                    <div class="col-lg-8">
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        Tidak bisa dilihat
    @endif
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- CHARTS -->
<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart->labels)!!} ,
            datasets: [
                {
                    label: 'Data Transaksi',
                    backgroundColor: {!! json_encode($chart->colours)!!} ,
                    data:  {!! json_encode($chart->dataset)!!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>
</body>
</html>
