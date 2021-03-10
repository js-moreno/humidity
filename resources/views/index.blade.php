<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humidity</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <!-- FOnt Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link href="{{ asset('/css/app.css') }}"  rel="stylesheet"></link>
    <script src="{{ asset('/js/app.js') }}"></script>    

    @mapstyles

    @mapscripts

</head>
<body>
<header>
    <img src="favicon.ico" alt="Humidity Icon" width=35>
    <h1>
        Humidity
    </h1>
</header>

    <div class="container mb-60">

        <form method="GET" action="/">.
            {{ csrf_field() }}
            <div class="m-3">
                <label for="place-selector" class="form-label">Place:</label>
                <div class="input-group">
                    <select class="form-control" name="city" id="place-selector" required>
                        <option value=""></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ (Request::get('city') == $city->id ? "selected":"") }}>
                                {{ $city->name }}, {{ $city->country->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"class="btn btn-primary">
                        Go
                    </button>
                </div>
            </div>            
        </form>

        <div id="response-container" class="container text-center">
           
            @if (isset($data))

            <div class="container" style="height:570px">
                @map([
                    'lat' => $data['location']['lat'],
                    'lng' => $data['location']['long'],
                    'zoom' => 7,
                    'markers' => [
                        [
                            'title' => $data['location']['city'].', '.$data['location']['country'],
                            'lat' => $data['location']['lat'],
                            'lng' => $data['location']['long'],
                            'popup' => '<h3>'.$data['location']['city'].', '.$data['location']['country'].'</h3><h1 class="humidity-popover">'.$data['current_observation']['atmosphere']['humidity'].'% </h1>',
                            'icon' => '/humidity-logo.png',
                            'icon_size' => [45, 45],
                        ],
                    ],
                ])
                <div class="d-flex justify-content-center mt-5">
                    <button type="button"  class="btn btn-outline-primary" data-toggle="modal" data-target="#humidity-modal">
                        Tracking
                    </button>
                </div>
            </div>


            <div class="modal fade" id="humidity-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{$data['location']['city']}}, {{$data['location']['country']}}</h5>
                            <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <ul>
                                <li>50%</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <small class="text-secondary fst-italic">
                Please select a place and click in GO to show its humidity
            </small>
            @endif

        </div>
    </div>
    <footer class="footer px-3">
        <span class="text-muted">
            Powered by
            <a href="https://github.com/js-moreno" target="_blank" rel="noopener noreferrer">JS Moreno</a>
        </span>
    </footer>
</body>
</html>
