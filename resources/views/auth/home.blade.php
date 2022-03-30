<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fame Home</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="navbar-brand">Fame</div>
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" href="/ousama/public/auth/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/years">Years</a>
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

        <div class="container logout-container">
            <div class="col-md-3">
                <h4>Logout</h4>
                <hr>
                <form>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="w-100 form-control" value="{{$LoggedUserInfo['fullname']}}">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group mt-4">
                        <label>Password</label>
                        <input type="text" class="w-100 form-control" value="{{$LoggedUserInfo['user'] }}">
                        <span class="text-danger"></span>
                    </div>
                    <a href="{{ route('auth.logout')}}" class="mt-4 w-50 btn btn-block btn-primary">Logout</a>

                </form>
        </div>
        </div>
    </div>
</body>
</html>
