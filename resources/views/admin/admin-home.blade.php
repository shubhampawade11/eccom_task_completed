<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            height: 100vh;
        }


        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #444;
            color: #fff;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content {
            padding: 20px;
            background-color: #fff;
            flex: 1;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination p {
            display: none;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            table {
                border: 0;
            }

            table thead {
                display: none;
            }

            table tr {
                border-bottom: 1px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }

            table td {
                display: block;
                text-align: right;
                font-size: 14px;
                position: relative;
                padding-left: 50%;
                padding-right: 10px;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }

            .responsive-img {
                max-width: 100px;
                height: auto;
            }
        }


        td img {
            max-width: 100px;
            height: auto;
            display: block;
        }

        .btn-left {
            margin-left: 80%;
        }

        a {
            color: #eef0f3;
            text-decoration: none;
        }
    </style>
</head>

<body>




    <!-- Main content -->
    <div class="main-content">
        <header class="header">
            <h1>Welcome, {{ $users->name }}</h1>
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <div class="content">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <button class="btn btn-primary btn-left"><a href="{{ route('product.add')}}">Add Product</a></button>
            <h1>Products List</h1>
            <table>
                <thead>
                    <tr>

                        <th>Product Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>

                        <td data-label="Image">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="responsive-img">

                        </td>
                        <td data-label="Name">{{ $product->name }}</td>
                        <td data-label="Description">{{ $product->description }}</td>
                        <td data-label="Price">${{ number_format($product->price, 2) }}</td>
                        <td data-label="Stock">{{ $product->stock }}</td>
                        <td data-label="Actions">
                            <button class="btn btn-primary"><a href="{{ route('products.edit', $product->id) }}">Edit</a></button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('myTable');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach((row, index) => {
                const serialNumberCell = row.querySelector('td[data-label="No"]');
                serialNumberCell.textContent = index + 1;
            });
        });
    </script>
</body>

</html>