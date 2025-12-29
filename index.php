<?php require("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Product Store | Dashboard</title>
</head>

<body class="bg-light">

    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2><a href="index.php" class="text-white text-decoration-none"><i class="bi bi-shop"></i> Cogzin Product
                    Store</a></h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">
                <i class="bi bi-plus-lg"></i> Add Product
            </button>
        </div>
    </div>

    <div class="container mt-4">
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Operation completed successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Something went wrong.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <table class="table table-hover text-center shadow-sm border">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="5%">#</th>
                    <th width="15%">Image</th>
                    <th width="15%">Name</th>
                    <th width="10%">Price</th>
                    <th width="30%">Description</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $query = "SELECT * FROM `products` ORDER BY `id` DESC";
                $result = mysqli_query($con, $query);
                $i = 1;

                if (mysqli_num_rows($result) > 0) {
                    while ($fetch = mysqli_fetch_assoc($result)) {
                        $imagePath = FETCH_SRC . $fetch['image'];
                        echo <<<product
                        <tr class="align-middle">
                        <td>$i</td>
                        <td>
                        <img src="$imagePath" 
                        style="width: 80px; height: 80px; object-fit: cover;" 
                         class="rounded border shadow-sm" alt="product image">
                         </td>
                        <td class="fw-bold">$fetch[name]</td>
                        <td class="text-success fw-bold">₹$fetch[price]</td>
                        <td class="text-muted small">$fetch[description]</td>
                        <td>
                            <div class="btn-group">
                                <a href="edit.php?id=$fetch[id]" class="btn btn-warning btn-sm me-2"><i class="bi bi-pencil"></i> Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirm_rem($fetch[id])"><i class="bi bi-trash"></i> Delete</button>
                            </div>
                        </td>
                    </tr>
                    product;
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='p-5 text-muted'>No products found. Start by adding one!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addproduct" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. Wireless Mouse"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price (INR)</label>
                            <input type="number" class="form-control" name="price" min="1" placeholder="e.g. 500"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="desc" rows="3" placeholder="Enter product details..."
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.webp"
                                required />
                            <div class="form-text">Supported: JPG, PNG, WEBP</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="addproduct">Save Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirm_rem(id) {
            if (confirm("Are you sure you want to delete this product? This action cannot be undone.")) {
                window.location.href = "crud.php?rem=" + id;
            }
        }
    </script>
</body>

</html>