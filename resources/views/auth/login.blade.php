@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4" style="margin-top: 50px;">

            <img src="{{asset('images/logo.png')}}" style="height: 100px; display: block;
    margin: 0 auto;">


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Sign In</h4>
                    <p class="text-subtitle text-muted text-center">Enter your email address and password.Use credentials you created on registration.</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="email-id-column">Email</label>
                                <input type="email" id="email-id-column" class="form-control  @error('email') is-invalid @enderror"
                                       placeholder="Email" name="email" value="{{old('email')}}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="email-id-column">Password</label>
                                <input type="password" id="email-id-column" class="form-control  @error('password') is-invalid @enderror"
                                       placeholder="Password" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <div class="row">
                                    <div class="col-md-12 col-12 offset-0">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a> | <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('Create Account') }}
                                            </a>
                                        @endif
                                    </div>

                                </div>




                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
