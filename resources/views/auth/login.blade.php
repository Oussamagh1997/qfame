<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fame Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3-dist\css\bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>

<body>
<div class='container login-container'>
    <div class="row">
        <div class="col-md-12">
            <h4>Login</h4><hr>
            <form action="{{ route('auth.check')}}" method="post">
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                    @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="w-100 form-control" name="user" placeholder="Enter Username" value="{{old('user')}}">
                    <span class="text-danger">@error('user'){{ $message }} @enderror</span>
                </div>
                <div class="form-group mt-4">
                    <label>Password</label>
                    <input type="password" class="w-100 form-control" name="pwd" placeholder="Enter password">
                    <span class="text-danger">@error('pwd'){{ $message }} @enderror</span>
                </div>
{{--                    <div class="d-flex align-items-center justify-content-end flex-column">--}}
                <button type="submit" class="w-50 btn btn-block btn-primary mt-4">Sign In</button>
                <a href="{{ route('auth.register') }}" class="d-block mt-2">I don't have an account. Create new one.</a>
{{--                    </div>--}}
            </form>
        </div>
    </div>
</div>
</body>
</html>