@extends('layouts.master')
@section('content')

<style>
    .container {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        padding: 2rem;
    }

    .heading {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        background: #fff;
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .category-name {
        font-weight: bold;
    }

    .category-actions a {
        color: #3490dc;
        text-decoration: none;
        margin-right: 10px;
        font-size: 14px;
    }

    .category-actions a:hover {
        text-decoration: underline;
    }

    .category-actions form {
        display: inline;
    }

    .delete-button {
        background-color: #e3342f;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .delete-button:hover {
        background-color: #cc1f1a;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <h2 class="heading">Categories</h2>

    {{-- <a href="{{ route('categories.create') }}">Create New Category</a> --}}

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <ul class="category-list">
        @foreach ($categories as $category)
            <li class="category-item">
                <span class="category-name">{{ $category->name }}</span>
                <span class="category-actions">
                    <a href="{{ route('categories.edit', $category) }}">Edit</a>
                    <form action="{{ route('categories.delete', $category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-button" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</div>

@endsection
