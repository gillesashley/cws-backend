@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="wrapper">
        <div class="row g-0 m-0">
            <div class="col-xl-6 col-lg-12">
                <div class="login-cover-wrapper">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>Sign In</h4>
                                <p>Sign In to your account</p>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required
                                        autofocus>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 text-end mb-3">
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12 col-lg-12">
                                <div class="position-relative border-bottom my-3">
                                    <div class="position-absolute seperator translate-middle-y">or continue with</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div
                                    class="social-login d-flex flex-row align-items-center justify-content-center gap-2 my-2">
                                    <a href="javascript:;"><img src="{{ asset('assets/images/icons/facebook.png') }}"
                                            alt=""></a>
                                    <a href="javascript:;"><img
                                            src="{{ asset('assets/images/icons/apple-black-logo.png') }}"
                                            alt=""></a>
                                    <a href="javascript:;"><img src="{{ asset('assets/images/icons/google.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 text-center">
                                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="position-absolute top-0 h-100 d-xl-block d-none login-cover-img">
                    <div class="text-white p-5 w-100">
                        <!-- You can add content here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
