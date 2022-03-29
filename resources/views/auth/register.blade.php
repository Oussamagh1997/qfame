<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fame Register</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
</head>

<body>
<div class='container'>
    <div class="row" style="margin-top:45px">
        <div class="col-md-4 col-md-offset-4">
            <h4>Register</h4><hr>
            <form action="{{ route('auth.save') }}" method="post">

            @if(Session::get('success'))
                <div class="alert alert-succcess">
                    {{ Session::get('success') }}

                </div>
            @endif

            @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}

                </div>
            @endif

            @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" value="{{old('fullname')}}">
                    <span class="text-danger">@error('fullname'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="user" placeholder="Enter Username" value="{{old('user')}}">
                    <span class="text-danger">@error('user'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Enter password">
                    <span class="text-danger">@error('pwd'){{ $message }}@enderror</span>
                </div>
                <br>
                <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                <br><br>
                <a href="{{ route('auth.login') }}">I already have an account, Sign In.</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>