@extends('visitor.layouts.app')
@section('content')

    <!-- Signup Section -->
    <section class="signup-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side - Image -->
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="signup-image">
                        <img src="{{ asset('logo/download.jpg') }}" alt="Shopping Cart" class="img-fluid">
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="col-lg-6 col-md-6">
                    <div class="signup-form-container">
                        <h1 class="signup-title">Create an account</h1>
                        <p class="signup-subtitle">Enter your details below</p>

                        <!-- Signup Form -->
                        <form action="{{ route('register') }}" method="POST" class="signup-form">
                            @csrf

                            <!-- Name Input -->
                            <div class="form-group">
                                <input type="text" name="name" class="form-control custom-input" placeholder="Name" required value="{{ old('name') }}">
                                @error('name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

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

                            <!-- Create Account Button -->
                            <button type="submit" class="btn btn-create-account">Create Account</button>

                            <!-- Sign up with Google -->
                            <button type="button" class="btn btn-google-signup">
                                <img src="{{ asset('images/google-icon.svg') }}" alt="Google" class="google-icon">
                                Sign up with Google
                            </button>

                            <!-- Already have account -->
                            <div class="login-link">
                                <span>Already have account?</span>
                                <a href="{{ route('login') }}">Log in</a>
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
