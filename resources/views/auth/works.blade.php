<?php
$con = mysqli_connect('localhost', 'root', '', 'fame');
$sel = "SELECT authors.author, works.date, works.title, works.workid  FROM  authors INNER JOIN
(works INNER JOIN authorof ON works.workid = authorof.workid )
ON authors.authorid = authorof.authorid";
$result1 = mysqli_query($con, $sel);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" rc="public/app.js"></script>
    <title>Fame Home</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
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
                <a class="nav-link active" href="/auth/works">Works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/types">Types</a>
            </li>
        </ul>
    </div>
    <div class="row" style="height:65vh;">
        <div class="col-md-4">
            <form method="POST" action="{{ url('/auth/works')}}">
                @csrf
                <select required size="20" class='scroll' id="works" name="works">
                    <?php while($row1 = mysqli_fetch_array($result1)):;?>
                    <option value="<?php echo $row1[3];?>"><?php echo $row1[0] . '-' . $row1[1] . '-' . $row1[2];?></option>
                    <?php endwhile;?>
                    <input class="btn-primary btn w-100 mt-4" type="submit">
                </select>
            </form>
        </div>
        <div class="col-md-5">
            <div class="results-1">
                <p class="title">Events</p>
                <form method="POST" action="{{ url('/events')}}">
                    @csrf
                    <select required size="20" class='scroll' id="event" name="event">
                        @if(isset($work))
                            @foreach($work as $w)
                                <option value="{{$w->eventid}}//-{{$w-> type_desc}}//-{{ $w->location }}//-{{ $w->year }}" >{{ $w->year }} - {{ $w->type_desc }} - {{ $w->location }}</option>
                            @endforeach
                        @endif
                        <br><br>
                        <input class="btn-primary btn w-100 mt-4" type="submit">
                    </select>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="results-2">
                <p class="title">Analysis</p>
                <form method="POST" action="{{ url('/edit/analysis')}}">
                    @csrf
                    <select required size="20" class='scroll' id="analysis" name="analysis">
                        @if(isset($ana))
                            @foreach($ana as $a)
                                <option value="{{$a->analysisid}}//-{{$a->title}}//-{{$a->type_desc}}//-{{$a->info_work}}//-{{strip_tags($a->comment)}}//-{{$w->eventid}}">{{ $a->info_work }} - {{ strip_tags($a->comment) }}</option>
                            @endforeach
                        @endif
                        <br><br>
                        <input class="btn-primary btn w-100 mt-4" type="submit">
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
