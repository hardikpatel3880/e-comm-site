@extends('visitor.layouts.app')
@section('content')

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side - Image -->
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="login-image">
                        <img src="{{ asset('logo/download.jpg') }}" alt="Shopping Cart" class="img-fluid">
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="col-lg-6 col-md-6">
                    <div class="login-form-container">
                        <h1 class="login-title">Log in to Exclusive</h1>
                        <p class="login-subtitle">Enter your details below</p>

                        <!-- Login Form -->
                        <form action="{{ route('login.submit') }}" method="POST" class="login-form">
                            @csrf

                            <!-- Email or Phone Input -->
                            <div class="form-group">
                                <input type="text" name="email" class="form-control custom-input" placeholder="Email or Phone Number" required value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="form-group">
                                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required>
                                @error('password')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Login Button and Forget Password -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-login">Log In</button>
                                <a href="{{ route('password.request') }}" class="forget-password">Forget Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
