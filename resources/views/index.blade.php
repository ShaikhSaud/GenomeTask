<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather App | Genome Task</title>

        <!-- Google Fonts CDN -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!-- Select2 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Meteocons Styles -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/meteocons/style.min.css') }}">

        <!-- Custom Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    </head>
    <body class="bg">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 my-5">
                    <div class="card py-4 weather-panel">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="logo">
                            <h1 class="display-2">Weather App</h1>
                            <p class="card-text">Please select a city from the dropdown to check weather</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('fetch_weather') }}" method="POST">
                                @csrf
                                <select class="form-control" name="city" id="citySelect" required>
                                    <option value="">Select a City...</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                                </select>
                            </form>

                            <div class="row">
                                <div class="col mt-4 px-9">
                                    <div class="text-center d-none" id="loading">
                                        <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading animation" s>
                                        <h2>Fetching Weather Details...</h2>
                                    </div>

                                    <div class="alert alert-danger d-none" role="alert" id="errorPanel"></div>

                                    <div class="card d-none" id="weatherCard">
                                        <div class="card-content">
                                            <div class="card-body bg-blue rounded-top">
                                                <div class="date-info position-absolute p-2 text-center">
                                                    <span class="date d-block"></span>
                                                    <span class="month"></span>
                                                </div>
                                                <div class="text-center">
                                                    <div class="d-block">
                                                        <img src="" alt="weather icon" class="w-icon">
                                                        <span class="text-primary condition"></span>
                                                    </div>
                                                    <span class="temp"></span>
                                                    <span class="location"></span>
                                                </div>
                                            </div>
                                            <div class="card-footer p-0 border-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="details-left float-left">
                                                                        <span class="weather-prop">
                                                                            <i class="me-wind text-info weather-icon"></i> Wind
                                                                        </span>
                                                                        <span class="text-bold-500 wind"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="details-left float-left">
                                                                        <span class="weather-prop">
                                                                            <i class="me-thermometer text-info weather-icon"></i> Feels Like
                                                                        </span>
                                                                        <span class="text-bold-500 feels"></span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="details-left float-left">
                                                                        <span class="weather-prop">
                                                                            <i class="me-windy text-info weather-icon"></i> Humidity
                                                                        </span>
                                                                        <span class="text-bold-500 humidity"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="details-left float-left">
                                                                        <span class="weather-prop">
                                                                            <i class="me-compass text-info weather-icon"></i> Pressure
                                                                        </span>
                                                                        <span class="text-bold-500 pressure"> mb</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <!-- Popper.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

        <!-- Bootstrap CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

        <!-- Select2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Custom Scripts -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>