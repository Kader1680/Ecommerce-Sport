
@extends("layouts.master")
@section("content")


    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            padding: 40px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
        }

        .alert {
            background: #ffe0e0;
            color: #b30000;
            padding: 10px 15px;
            border: 1px solid #ffb3b3;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Add New Product</h2>

    @if ($errors->any())
        <div class="alert">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="description">Description</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        <label for="price">Price ($)</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" required>

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image">

        <button type="submit" class="btn">Create Product</button>
    </form>
</div>



@endsection


