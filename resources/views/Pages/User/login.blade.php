@extends('Layouts.Home.home')

@section('content')
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        @if (session()->has('registration_success'))
                            <div class="alert alert-success col-md-11">{{ session('registration_success') }}</div>
                        @endif
                        @if (session()->has('login_error'))
                            <div class="alert alert-danger col-md-11">{{ session('login_error') }}</div>
                        @endif
                        @if (session()->has('forbidden'))
                            <div class="alert alert-danger col-md-11">{{ session('forbidden') }}</div>
                        @endif
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <h3>Login</h3>
                        <form action="{{ route('login.login') }}" method="POST">
                            @csrf
                            <div class="input__item">
                                <input type="text" placeholder="Email address" name="email" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Password" name="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Login Now</button>
                        </form>
                        <a href="#" class="forget_pass">Forgot Your Password?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Dont’t Have An Account?</h3>
                        <a href="{{ route('register.index') }}" class="primary-btn">Register Now</a>
                    </div>
                </div>
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>or</span>
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With
                                        Facebook</a></li>
                                <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a>
                                </li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
