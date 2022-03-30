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
            @if(isset($event))
                {{ $event[0]}} - {{$event[1]}} in {{ $event[2]}} ({{ $event[3]}})
            @endif
        </p>
        <div class="cont">
            <p class="title">Event</p>
            <div class="flex">
                <label>Year
                    <input type="number" value="{{$event[3]}}" disabled>
                </label>
                <label>Location
                    <select disabled>
                        <option>{{$event[2]}}</option>
                    </select>
                </label>
                <label>Type
                    <select disabled>
                        <option>{{$event[1]}}</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="flex">
            <div class="col-md-6 p-2">
                    <p class="title">Analysis</p>
                    <form method="POST" action="{{ url('/edit/analysis')}}">
                        @csrf
                        <select required size="18" class='scroll' id="analysis" name="analysis" >
                            @if(isset($analysis))
                                @foreach($analysis as $a)
                                    <option class="option1" value="{{$a->analysisid}}//-{{$a->title}}//-{{$a->type_desc}}//-{{$a->info_work}}//-{{strip_tags($a->comment)}}//-{{$event[0]}}">{{$a->author}} ({{$a->date}}). {{$a->title}}. {{$a->info_work}}</option>
                                    <option value="{{$a->analysisid}}//-{{$a->title}}//-{{$a->type_desc}}//-{{$a->info_work}}//-{{strip_tags($a->comment)}}//-{{$event[0]}}">{{strip_tags($a->comment)}}</option>
                                @endforeach
                            @endif

                            <input class="btn-primary btn w-100 mt-4" type="submit">
                        </select>
                    </form>
            </div>
            <div class="col-md-6 p-2">
                <div>
                    <p class="title">Extracts</p>
                    <form method="POST" action="{{ url('/edit/extract')}}">
                        @csrf
                        <select required size="18" class='scroll' id="extracts" name="extracts">
                            @if(isset($extracts))
                                @foreach($extracts as $ext)
                                    <option class="option1" value="{{$ext->extractid}}//-{{$ext->extract}}//-{{$ext->source}}//-{{$ext->extract_info}}//-{{$ext->sourceid}}">{{ $ext->source }}</option>
                                    <option value="{{$ext->extractid}}//-{{$ext->extract}}//-{{$ext->source}}//-{{$ext->extract_info}}//-{{$ext->sourceid}}">{{ $ext->extract }}.</option>
                                @endforeach
                            @endif
                            <input class="btn-primary btn w-100 mt-4" type="submit">
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
