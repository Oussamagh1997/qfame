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
                <a class="nav-link" href="/auth/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/years">Years</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/sources">Sources</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/locations">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/works">Works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/types">Types</a>
            </li>
        </ul>
    </div>
    <div class="row" style="height:65vh;">
        <p class="eventtitle">
            @if(isset($source))
                {{$source[1]}}. Edit {{$source[0]}}
            @endif
        </p>
        <div class="cont">
            <p class="title">Source</p>
            <div>
                <textarea rows="1">{{$source[0]}}</textarea>
            </div>
        </div>
        <div class="flexanalysis">
            <div class="cont col-8">
                <p class="title">Extracts</p>
                <div>
                    <form method="POST" action="{{ url('/edit/annales')}}">
                        @csrf
                        <select required size="18" class='scroll' id="extra" name="extra">
                            @foreach($extracts as $ext)
                                <option value="{{$ext->extractid}}//-{{$source[0]}}//-{{$source[1]}}">{{$ext->extract}}</option>
                            @endforeach
                        </select>
                        <input class="btn-primary btn w-100 mt-4" type="submit">
                    </form>
                </div>
                <div class="cont">
                    <p>Extract-based Analysis</p>
                    <form method="POST" action="{{ url('/edit/analysis')}}">
                        @csrf
                        <select required size="20" class='scroll' id="analysis" name="analysis" >
                            @if(isset($analysis))
                                @foreach($analysis as $a)
                                    <option class="option1" value="{{$a->analysisid}}//-{{$a->title}}//-{{$a->type_desc}}//-{{$a->info_work}}//-{{strip_tags($a->comment)}}//-{{$a->eventid}}">{{$a->author}} ({{$a->date}}). {{$a->title}}. {{$a->info_work}}</option>
                                    <option value="{{$a->analysisid}}//-{{$a->title}}//-{{$a->type_desc}}//-{{$a->info_work}}//-{{strip_tags($a->comment)}}//-{{$a->eventid}}">{{strip_tags($a->comment)}}</option>
                                @endforeach
                            @endif
                            <br><br>
                            <input class="btn-primary btn w-100 mt-4" type="submit">
                        </select>
                    </form>
                </div>
                <div class="cont">
                    <p>URL</p>
                    <div>
                        @if(isset($link))
                            @foreach($link as $l)
                                <a href="{{$l->link}}">{{$l->name}} ({{$l->site}})</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4 cont">
                <p class="title">Cited By</p>
                <textarea rows="25"></textarea>
            </div>
        </div>
    </div>
</div>
</body>
</html>
