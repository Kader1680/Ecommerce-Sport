@extends('layouts.master')

@section('content')
<style>
    :root {
        --primary-dark: #111111;
        --accent-red: #ff4747;
        --border-gray: #e1e1e1;
        --text-gray: #666;
        --bg-soft: #fcfcfc;
    }

    /* Page Wrapper to center form */
    .auth-page-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: var(--bg-soft);
    }

    .auth-card {
        width: 100%;
        max-width: 450px;
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .auth-card h2 {
        font-size: 2rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        color: var(--primary-dark);
        text-transform: uppercase;
    }

    .auth-subtitle {
        text-align: center;
        color: var(--text-gray);
        font-size: 0.95rem;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 8px;
        color: var(--primary-dark);
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        font-size: 1rem;
        border: 1.5px solid var(--border-gray);
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
    }

    /* Error Styling */
    .error-input {
        border-color: var(--accent-red) !important;
    }

    .error-msg {
        color: var(--accent-red);
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 5px;
        display: block;
    }

    /* Remember Me & Links */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 0.9rem;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .checkbox-group input {
        width: 16px;
        height: 16px;
        accent-color: var(--primary-dark);
    }

    .login-btn {
        width: 100%;
        padding: 14px;
        background-color: var(--primary-dark);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .login-btn:hover {
        background-color: #333;
        transform: translateY(-1px);
    }

    .auth-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 0.9rem;
        color: var(--text-gray);
    }

    .auth-footer a {
        color: var(--primary-dark);
        text-decoration: none;
        font-weight: 700;
        border-bottom: 2px solid var(--accent-red);
    }

    /* Responsive */
    @media (max-width: 480px) {
        .auth-card {
            padding: 30px 20px;
            box-shadow: none;
            border: none;
            background: transparent;
        }
        .auth-page-wrapper {
            background-color: #fff;
        }
    }
</style>

<div class="auth-page-wrapper">
    <div class="auth-card">
        <h2>Welcome Back</h2>
        <p class="auth-subtitle">Sign in to access your athlete profile.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" 
                    class="form-control @error('email') error-input @enderror" 
                    placeholder="email@example.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" 
                    class="form-control @error('password') error-input @enderror" 
                    placeholder="••••••••" required>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="checkbox-group">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                {{-- Add a "Forgot Password" link here if your route exists --}}
                {{-- <a href="#" style="color: var(--text-gray); text-decoration: none;">Forgot Password?</a> --}}
            </div>

            {{-- Submit --}}
            <button type="submit" class="login-btn">
                Log In
            </button>
        </form>

        <p class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Join Now</a>
        </p>
    </div>
</div>
@endsection