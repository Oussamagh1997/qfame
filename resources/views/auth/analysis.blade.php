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
    <div class="row" style="height:65vh;">
        <p class="eventtitle">
            @if(isset($ana))
                Edit analysis ({{$ana[0]}})
            @endif
        </p>
        <div class="cont">
            <p class="title">Analysis</p>
            <div class="cont">
                <p class="title">Work</p>
                <div class="flexv">
                    <div class="p-1">
                        <select class="w-100">
                            <option>{{ $ana[1] }} ({{$ana[2]}})</option>
                            @foreach($works as $w)
                                @if( $w->title != $ana[1])
                                <option>{{$w->title}} ({{$w->type_desc}})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="p-1">
                        <textarea rows="1">{{ $ana[3] }}</textarea>
                    </div>
                </div>
            </div>
            <div class="cont">
                <p class="title">Comment</p>
                <div class="p-1">
                <textarea rows="5" style="overflow-y: scroll;">{{$ana[4]}}</textarea>
            </div>
        </div>
        <div class="">
            <div class="cont">
                <p class="title">On Events</p>
                <div class="flexanalysis">
                    <div class="p-1 col-md-6">
                        <p>Events Analyzed</p>

                        <select required size="20" class='scroll' id="" name="">
                            @foreach($event as $e)
                                <option class="option1" value="">{{$e->year}} - {{$e->type_desc}} - {{$e->location}}</option>
                        </select>
                    </div>
                    <div class="p-1 col-md-6">
                        <p>Extracts Used</p>
                        <form method="POST" action="{{ url('/edit/report')}}">
                            @csrf
                            <select required size="20" class='scroll' id="report1" name="report1" >
                                @if(isset($extracts))
                                    @foreach($extracts as $ext)
                                        @if($ext->extract != null)
                                            <option class="option1" value="{{$ext->source}}//-{{$ext->extract}}//-{{$e->eventid}}//-{{$ext->extractid}}">{{ $ext->source }}</option>
                                            <option value="{{$ext->source}}//-{{$ext->extract}}//-{{$e->eventid}}//-{{$ext->extractid}}">{{ $ext->extract }}</option>
                                            <option value="{{$ext->source}}//-{{$ext->extract}}//-{{$e->eventid}}//-{{$ext->extractid}}">Intensity = {{$intensity[0]->intensity}}
                                                @if($intensity[0]->certainty_location != 1)
                                                    Location Certainty = {{$intensity[0]->certainty_location}}</option>
                                                @endif
                                        @else
                                            <option class="option1" value="{{$ext->source}}//-0//-{{$e->eventid}}//-{{$ext->extractid}}">{{ $ext->source }}</option>
                                            <option value="{{$ext->source}}//-0//-{{$e->eventid}}//-{{$ext->extractid}}">{{ $ext->extract }}</option>
                                            <option value="{{$ext->source}}//-0//-{{$e->eventid}}//-{{$ext->extractid}}">Intensity = {{$intensity[0]->intensity}}
                                                @if($intensity[0]->certainty_location != 1)
                                                    Location Certainty = {{$intensity[0]->certainty_location}}</option>
                                                @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                                <br><br>
                                <input class="btn-primary btn w-100 mt-4" type="submit">
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="">
                <div class="cont">
                    <p class="title">On Extracts</p>
                    <div class="flexanalysis">
                        <div class="p-1 col-md-6">
                            <p>Extracts Analyzed</p>
                            <form method="POST" action="{{ url('/edit/extract')}}">
                                @csrf
                                <select required size="20" class='scroll' id="extracts" name="extracts" >
                                    @if(isset($extracts))
                                        @foreach($extracts as $ext)
                                            <option class="option1" value="{{$ext->extractid}}//-{{$ext->extract}}//-{{$ext->source}}//-{{$ext->extract_info}}//-{{$ext->sourceid}}">{{ $ext->source }}</option>
                                            @if($ext->extract != null)
                                            <option value="{{$ext->extractid}}//-{{$ext->extract}}//-{{$ext->source}}//-{{$ext->extract_info}}//-{{$ext->sourceid}}">{{ $ext->extract }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    <br><br>
                                    <input class="btn-primary btn w-100 mt-4" type="submit">
                                </select>
                            </form>
                        </div>
                        <div class="p-1 col-md-6">
                            <p>Events Used</p>
                            <form method="POST" action="{{ url('/edit/report')}}">
                                @csrf
                                <select required size="20" class='scroll' id="report2" name="report2">
                                    @foreach($event as $e)
                                        @if($ext->extract != null)
                                            <option class="option1" value="{{$ext->source}}//-{{$ext->extract}}//-{{$e->eventid}}//-{{$ext->extractid}}">{{$e->year}} - {{$e->type_desc}} - {{$e->location}}</option>
                                            <option value="{{$ext->source}}//-{{$ext->extract}}//-{{$e->eventid}}//-{{$ext->extractid}}">Intensity = {{$intensity[0]->intensity}}
                                                @if($intensity[0]->certainty_location != 1)
                                                    Location Certainty = {{$intensity[0]->certainty_location}}</option>
                                                @endif
                                        @else
                                            <option class="option1" value="{{$ext->source}}//-0//-{{$e->eventid}}//-{{$ext->extractid}}">{{$e->year}} - {{$e->type_desc}} - {{$e->location}}</option>
                                            <option value="{{$ext->source}}//-0//-{{$e->eventid}}//-{{$ext->extractid}}">Intensity = {{$intensity[0]->intensity}}
                                                @if($intensity[0]->certainty_location != 1)
                                                    Location Certainty = {{$intensity[0]->certainty_location}}</option>
                                                @endif
                                        @endif
                                    @endforeach
                                    <br><br>
                                    <input class="btn-primary btn w-100 mt-4" type="submit">
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
