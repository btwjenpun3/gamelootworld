@extends('Layouts.Home.home')

@section('content')
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <h3>Sign Up</h3>
                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf
                            <div class="input__item">
                                <input type="text" placeholder="Email address" name="email" value="{{ old('name') }}"
                                    required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Your Name" name="name" value="{{ old('email') }}"
                                    required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Password" name="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Register</button>
                        </form>
                        <h5>Already have an account? <a href="{{ route('login.index') }}">Log In!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <h3>Login With:</h3>
                        <ul>
                            {{-- <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a> --}}
                            </li>
                            <li><a href="{{ route('login.redirectToGoogle') }}" class="google"><i class="fa fa-google"></i>
                                    Sign in With Google</a></li>
                            {{-- <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
