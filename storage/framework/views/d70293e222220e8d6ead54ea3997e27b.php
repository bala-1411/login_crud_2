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
            <?php if(auth()->user()->role == 'admin'): ?>
                <a href="<?php echo e(route('product.create')); ?>" class="btn btn-primary">Create a Product</a>
            <?php endif; ?>
            <button id="exportButton" class="btn btn-secondary">Export to Excel</button>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger float-right">Logout</button>
            </form>
        </div>
        <h1 class="my-4">Product List</h1>
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <table id="productTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    <?php if(auth()->user()->role == 'admin'): ?>
                        <th>Edit</th>
                        <th>Delete</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->id); ?></td>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->qty); ?></td>
                        <td><?php echo e($product->price); ?></td>
                        <td><?php echo e($product->description); ?></td>
                        <?php if(auth()->user()->role == 'admin'): ?>
                            <td>
                                <a href="<?php echo e(route('product.edit', ['product' => $product])); ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form method="post" action="<?php echo e(route('product.destroy', ['product' => $product])); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo method_field('delete'); ?>
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" />
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\Laravel-11-User-Roles-and-Permissions-main\resources\views/products/index.blade.php ENDPATH**/ ?>