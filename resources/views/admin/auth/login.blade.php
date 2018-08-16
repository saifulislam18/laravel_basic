<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <title>{{ config('app.name', 'Laravel Multi Auth Guard')}}-Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('admin')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="{{asset('admin')}}/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="{{asset('admin')}}/css/custom.css">
    <link rel="shortcut icon" href="{{asset('admin')}}/img/favicon.ico">


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>
</head>
<body>
<div class="page login-page text-center">
    <div class="container">
        <div class="form-outer text-center d-flex align-items-center row justify-content-md-center">
            <div class="form-inner">
                <div class="logo text-uppercase"><span>TuT</span><strong class="text-primary">Xpert</strong></div>

                <div class="error">
                    @if ($errors->has('email'))
                        <span class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @endif

                    @if ($errors->has('username'))
                        <span class="alert alert-danger">
                        {{ $errors->first('username') }}
                    </span>
                    @endif
                </div>

                <form method="post" action="{{ route('login.submit') }}" class="text-left form-validate">
                    @csrf

                    <div class="form-group-material">
                        <label for="email" class="label-material">Username</label>
                        <input id="email" type="text" name="login" data-msg="Please enter your username"
                               class="input-material {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group-material">
                        <label for="password" class="label-material">Password</label>
                        <input id="password" type="password" name="password"
                               class="input-material{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="alert alert-danger">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                        @endif
                    </div>

                    <div class="form-group-material">
                        <label>
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                <a href="{{ route('password.reset') }}" class="forgot-pass">Forgot Password?</a>
                <small>Do not have an account?</small>
                <a href="{{ route('register') }}" class="signup">Signup</a>
            </div>

            <div class="copyrights text-center">
                <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript files-->
<script src="{{asset('admin')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('admin')}}/js/custom.js"></script>
</body>
</html>