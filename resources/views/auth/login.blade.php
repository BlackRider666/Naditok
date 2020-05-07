<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Login
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{asset('css/vendors.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('css/app.bundle.css')}}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" media="screen, print" href="{{asset('css/page-login.css')}}">
</head>
<body>
<div class="blankpage-form-field">
    <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
            <span class="page-logo-text mr-1">Naditok Admin</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <button type="submit" class="btn btn-default float-right">{{ __('Login') }}</button>
        </form>
    </div>
</div>
<script src="{{asset('js/vendors.bundle.js')}}"></script>
<script src="{{asset('js/app.bundle.js')}}"></script>
<!-- Page related scripts -->
</body>
</html>
