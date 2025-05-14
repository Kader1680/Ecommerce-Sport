
@extends("layouts.master")
@section("content")
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5f7fa;
            padding: 30px;
            margin: 0;
        }

        h2 {
            margin-bottom: 10px;
        }

        .section {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            color: white;
        }

        .pending { background-color: orange; }
        .paid { background-color: green; }
        .shipped { background-color: blue; }
        .cancelled { background-color: red; }

        .add{
    background-color: #07b851db;
    color: white;
    font-size: 12px;
    font-weight: 700;
    height: fit-content;
    padding: 4px;
    border-radius: 4px;
    text-decoration-line: none;
        }

    </style>
</head>
<body>

    <div class="section">
        <div style="display: flex; justify-content: space-between;">
             <h2>All Products</h2>
            <div>
             <a class="add" href="/admin/products/create">Add new product</a>
             <a class="add" href="/admin/categories/create">Add new category</a>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price ($)</th>
                    <th>Description</th>
                    <th>image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="60" height="60" style="object-fit: cover; border-radius: 6px;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>All Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td><span class="status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
@endsection