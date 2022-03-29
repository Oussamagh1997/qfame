<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" href="{{asset('app.js')}}"></script>
    <title>Fame Event</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="navbar-brand">Fame</div>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/years">Years</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/sources">Sources</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/locations">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/works">Works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ousama/public/auth/types">Types</a>
            </li>
        </ul>
    </div>
    <div class="row" style="height: 65vh;">
        <p class="eventtitle">
            @if(isset($extract))
                ({{$extract[0]}}) Edit the extract
            @endif
        </p>
        <div class="">
            <div class="cont col-md-12">
                <p class="title">Extract</p>
                <div class="flex-wrap">
                    <div class="">
                        <label>Source</label>
                        <form method="POST" action="{{ url('/edit/annales')}}">
                        @csrf
                            <select required class='scroll' id="source" name="source" >
                                <option value="{{$extract[2]}}//-{{$extract[4]}}">{{ $extract[2] }}</option>
                            </select>
                            <input class="btn-primary btn w-100 mt-2 mb-3" type="submit" value="Check Source">
                        </form>
                    </div>
                    <div class="col-md-12 mt-3">
                        <textarea rows="1">{{$extract[3]}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <p>Extract</p>
                        <textarea rows="5" class="overflow-scroll">{{$extract[1]}}</textarea>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="col-md-5 flex-row-reverse">
                    <div class="cont col-md-12">
                            <p class="title">Comments</p>
                            <textarea rows="8"></textarea>
                    </div>
                    <div class="cont col-md-12">
                            <p class="title">Related Sources</p>
                            <textarea rows="8"></textarea>
                    </div>
                </div>
                <div class="cont col-md-6">
                    <p class="title">Events Reported</p>
                    <form method="POST" action="{{ url('/events')}}">
                        @csrf
                        <select required size="20" class='scroll' id="event" name="event" >
                            @foreach($event as $e)
                                <option value="{{$e->eventid}}//-{{$e->type_desc}}//-{{$e->location}}//-{{$e->year}}">{{$e->year}} - {{$e->type_desc}} - {{$e->location}}</option>
                            @endforeach
                            <input class="btn-primary btn w-100 mt-4" type="submit"/>
                        </select>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>