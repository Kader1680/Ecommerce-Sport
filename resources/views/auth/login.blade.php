@extends('layouts.master')

@section('content')
<div class="auth-form-container" style="max-width: 400px; margin: 50px auto; padding: 30px; background: #f9f9f9; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label for="email" style="display:block; font-weight: bold;">Email</label>
            <input type="email" name="email" required
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 20px;">
            <label for="password" style="display:block; font-weight: bold;">Password</label>
            <input type="password" name="password" required
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @error('password')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
            style="width: 100%; padding: 10px; background-color: #111; color: white; border: none; border-radius: 4px; font-weight: bold;">
            Login
        </button>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        Don't have an account? <a href="{{ route('register') }}" style="color: #3490dc;">Register here</a>
    </p>
</div>
@endsection
