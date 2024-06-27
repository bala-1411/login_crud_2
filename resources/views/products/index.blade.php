<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        table {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="my-3">
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('product.create') }}" class="btn btn-primary">Create a Product</a>
            @endif
            <button id="exportButton" class="btn btn-secondary">Export to Excel</button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger float-right">Logout</button>
            </form>
        </div>
        <h1 class="my-4">Product List</h1>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table id="productTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Edit</th>
                        <th>Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('product.edit', ['product' => $product]) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}" class="d-inline">
                                    @csrf 
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" />
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportButton').addEventListener('click', function () {
            var wb = XLSX.utils.table_to_book(document.getElementById('productTable'), { sheet: "Sheet JS" });
            XLSX.writeFile(wb, 'products.xlsx');
        });
    </script>
</body>
</html>
