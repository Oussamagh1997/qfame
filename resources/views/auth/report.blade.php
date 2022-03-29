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
        <div class="cont">
            <p class="eventtitle">
                Edit Analysis Report
            </p>
            <div class="cont">
                <p class="title">Extract</p>
                <label>Source</label>
                <select required size="1" class='scroll' id="" name="" >
                    <option selected disabled value="">{{ $report[0] }}</option>
                </select>
                <div class="cont">
                    <p class="title">Extracts</p>
                    <select required size="13" class='scroll' id="" name="" >
                        @foreach($extracts as $e)
                            @if($e->extract == $report[1])
                                <option selected style="background-color: #0a58ca">{{$report[1]}}</option>
                            @else
                                <option value="">{{$e->extract}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <textarea style="overflow-y: scroll;" rows="12" disabled>{{$report[1]}}</textarea>
                </div>
            </div>
            <div class="cont">
                <p class="title">Event</p>
                <div class="flex">
                    <label>Criteria1
                        <select>
                            <option selected disabled>Year</option>
                        </select>

                        <select>
                            <option selected disabled>{{$event->year}}</option>
                        </select>
                    </label>

                    <label>Criteria2
                        <select>
                            <option selected disabled>Type</option>
                        </select>

                        <select>
                            <option selected disabled>{{$event->type_desc}}</option>
                        </select>
                    </label>

                    <label>Criteria3
                        <select>
                            <option selected disabled>Location</option>
                        </select>

                        <select>
                            <option selected disabled>{{$event->location}}</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        <div class="cont">
            <p class="title">Information</p>
            <div class="flex p-2">
                <label>Intensity
                    <input type="number" step="0.01" min="0" max="1"  value="{{$info->intensity}}">
                </label>
                <label>Location Certainty
                    <input type="number" step="0.01" min="0" max="1" value="{{$info->certainty_location}}">
                </label>
                <label>Date Certainty
                    <input type="number" step="0.01" min="0" max="1" value="{{$info->certainty_date}}">
                </label>
                <label>Original
                @if(isset($info->original_date))
                    <input type="number" step="1" min="700" max="1500" value="{{$info->original_date}}">
                @else
                    <input type="number" step="1" min="700" max="1500" value="{{$event->year}}">
                @endif
                </label>
            </div>
            <div class="p-2">
                <select>
                    <option selected disabled>{{$comp->method}}</option>
                </select>
            </div>
        </div>
    </div>
</div>
</body>
</html>