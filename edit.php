<?php 
require("connection.php"); 

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM `products` WHERE `id` = '$id'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Edit Product</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="crud.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $fetch['name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" class="form-control" name="price" value="<?php echo $fetch['price']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" name="desc" rows="3" required><?php echo $fetch['description']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Image</label><br>
                                <img src="<?php echo FETCH_SRC . $fetch['image']; ?>" width="100px" class="mb-2 rounded border shadow-sm">
                                <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg">
                                <small class="text-muted">Leave blank to keep current image</small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success" name="editproduct">Update Details</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>