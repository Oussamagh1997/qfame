<?php
$con=mysqli_connect('remotemysql.com','R63KoApJgQ','CPoZ81u326','R63KoApJgQ');
$sel="SELECT year FROM years";
$result1= mysqli_query($con,$sel);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" href="{{asset('app.js')}}"></script>
    <title>Fame Home</title>
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
                <a class="nav-link active" href="/auth/years">Years</a>
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
            <div class="col-md-4">
                <div>
                    <form method="POST" action="{{ url('/auth/years')}}">
                        @csrf
                        <select required size="20" class='scroll' id="year" name="year" >
                            <?php while($row1=mysqli_fetch_array($result1)):;?>
                            <option  value="<?php echo $row1[0];?>" ><?php echo $row1[0];?></option>
                            <?php endwhile;?>
                            <br><br>
                            <input class="btn-primary btn w-100 mt-4" type="submit">
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="results">
                    <p class="title">Events</p>
                    <form method="POST" action="{{ url('/events')}}">
                        @csrf
                        <select required size="20" class='scroll' id="event" name="event">
                            @if(isset($year))
                                @foreach($year as $y)
                                    <option value="{{$y->eventid}}//-{{$y->type_desc}}//-{{ $y->location }}//-{{ $y->year }}" >{{ $y->type_desc}} - {{ $y->location }}</option>
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
</div>
</body>
</html>
