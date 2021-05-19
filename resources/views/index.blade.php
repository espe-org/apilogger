<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APILogger') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Nunito', sans-serif;font-size: 0.9rem;line-height: 1.6">
<div class="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'APILogger') }}
            </a>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="w-100 d-flex justify-content-between">
                <h3 class="text-center">Api Logger</h3>
                <form method="POST" action="{{ route('apilogs.deletelogs') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger delete-logs" value="Delete Logs">
                    </div>
                </form>
            </div>
            <div class="list-group">
                @forelse ($apilogs as $key => $log)
                    <div class="list-group-item list-group-item-action" style="margin:5px">
                        <div class = "row w-100">
                            <span class="col-md-3">
                                @if ($log->response>400)
                                    <button class="btn btn-danger font-weight-bold">{{$log->method}}</button>
                                @elseif($log->response>300)
                                    <button class="btn btn-info font-weight-bold">{{$log->method}}</button>
                                @else
                                    <button class="btn btn-{{$log->method=="GET"? "primary" : "success"}} font-weight-bold">{{$log->method}}</button>
                                @endif

                                <small class="col-md-2">
                                    <b>{{$log->response}}</b>
                                </small>
                            </span>
                            <large class= "col-md-3"><b>Duration : </b>{{$log->duration * 1000}}ms</large>
                            <large class= "col-md-3"><b>Date : </b>{{$log->created_at}}</large>
                            <p class="col-md-3 mb-1"><b>URL :</b> {{$log->url}}</p>
                        </div>
                        <hr>
                        <a class="btn btn-link btn btn-link collapsed" href="#collapse{{$log->id}}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{$log->id}}">+++</a>
                        <div class="collapse" id="collapse{{$log->id}}" aria-expanded="false" aria-controls="collapse{{$log->id}}">
                            <div class="row w-100">
                                <p class="col-md-3 mb-1">
                                    <b>IP : </b>{{$log->ip}}</br>
                                </p>
                                <p class="col-md-6 mb-1"><b>Models(Retrieved) :</b> {{$log->models}}</p>
                            </div>
                            <div class="row w-100">
                                <p class="col-md-3">
                                    <b>Method :</b>   {{$log->action}}
                                </p>
                                <p class="col-md-3 mb-1"><b>Payload : </b>                            <?php
                                    dump($log->payload)
                                    ?></p>

                                <p class="col-md-6">
                                    <b>Controller :</b> {{$log->controller}}

                                </p>
                                <?php
                                dump($log->response_data)
                                ?>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5>
                        No Records
                    </h5>
                @endforelse

            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

