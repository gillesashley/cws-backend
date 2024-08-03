@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-bg-overlay au-sign-up-basic">
        <div class="text-center">
            <a href="javascript:;"><img src="{{ asset('assets/images/logo-icon-3.png') }}" width="140" alt=""></a>
        </div>
        <div class="mt-5">
            <div class="card radius-10">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h4>Sign In</h4>
                        <p>Sign In to your account</p>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-12 col-lg-12">
                            <div class="d-grid gap-2">
                                <a href="javascript:;" class="btn border border-2 border-primary">
                                    <img src="{{ asset('assets/images/icons/google.png') }}" width="20" alt="">
                                    <span class="ms-3 fw-500">Sign in with Google</span>
                                </a>
                                <a href="javascript:;" class="btn border border-2 border-dark">
                                    <img src="{{ asset('assets/images/icons/apple-black-logo.png') }}" width="20"
                                        alt="">
                                    <span class="ms-3 fw-500">Sign in with Apple</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="position-relative border-bottom my-3">
                                <div class="position-absolute seperator-2 translate-middle-y">OR</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 text-end">
                            <a href="{{ route('password.request') }}"
                                style="pointer-events: none; color: gray; text-decoration: none;">Forgot Password?</a>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12 text-center">
                            <p class="mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    style="pointer-events: none; color: gray; text-decoration: none;">Sign up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 fs-5 justify-content-center social-login-footer mt-4">
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
        </div>

        <div class="text-center mt-4">
            Copyright © 2021 UI Admin by Codervent.
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch('{{ route('login') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                        remember: document.getElementById('remember').checked
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endpush
