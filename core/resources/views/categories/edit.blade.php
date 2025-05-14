@extends('layouts.master')
@section('content')

<style>
    .form-container {
        background-color: #f9f9f9;
        padding: 2rem;
        max-width: 500px;
        margin: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .form-button {
        background-color: #3490dc;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-button:hover {
        background-color: #2779bd;
    }
</style>

<div class="form-container">
    <h2 class="form-title">Edit Category</h2>

    <form action="{{ route('categories.edit', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-input" value="{{ $category->name }}" required>
        <button type="submit" class="form-button">Update</button>
    </form>
</div>

@endsection
