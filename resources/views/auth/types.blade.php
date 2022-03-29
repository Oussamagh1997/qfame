<?php
$con=mysqli_connect('localhost','root','','fame');
$sel="SELECT type_desc FROM eventtypes";
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
    <script type="text/javascript" rc="public/app.js"></script>
    <title>Fame Home</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <a class="nav-link active" href="/ousama/public/auth/types">Types</a>
            </li>
        </ul>
    </div>
    <div class="row" style="height:65vh;">
        <div class="col-md-4">
            <form method="POST" action="{{ url('/auth/types')}}">
                @csrf
                <select required size="20" class='scroll' id="type" name="type" >
                    <?php while($row1=mysqli_fetch_array($result1)):;?>
                    <option  value="<?php echo $row1[0];?>" ><?php echo $row1[0];?></option>
                    <?php endwhile;?>
                    <input class="btn-primary btn w-100 mt-4" type="submit">
                </select>
            </form>
        </div>
        <div class="col-md-8">
            <div class="results">
                <p class="title">Events</p>
                <form method="POST" action="{{ url('/events')}}">
                    @csrf
                    <select required size="20" class='scroll' id="event" name="event">
                        @if(isset($type))
                            @foreach($type as $t)
                                <option value="{{$t->eventid}}//-{{$t-> type_desc}}//-{{ $t->location }}//-{{ $t->year }}" >{{ $t->year }} - {{ $t->location }}</option>
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