<?php
require("connection.php");

// CREATE OPERATION
if(isset($_POST['addproduct'])) {
    // Sanitize input to prevent SQL Injection
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = $_POST['price'];
    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    
    // Process Image
    $img_name = time() . "_" . $_FILES['image']['name']; 
    $tmp_name = $_FILES['image']['tmp_name'];
    
    if(move_uploaded_file($tmp_name, UPLOAD_SRC . $img_name)) {
        $query = "INSERT INTO `products`(`name`, `price`, `description`, `image`) 
                  VALUES ('$name', '$price', '$desc', '$img_name')";
        
        if(mysqli_query($con, $query)) {
            header("location: index.php?success=1");
        } else {
            header("location: index.php?error=db");
        }
    } else {
        header("location: index.php?error=upload");
    }
}

// DELETE OPERATION
if(isset($_GET['rem'])) {
    $id = mysqli_real_escape_string($con, $_GET['rem']);
    
    // Fetch image name to delete it from folder
    $get_query = "SELECT `image` FROM `products` WHERE `id`='$id'";
    $res = mysqli_query($con, $get_query);
    $data = mysqli_fetch_assoc($res);
    
    if($data) {
        unlink(UPLOAD_SRC . $data['image']); // Remove file from server
        mysqli_query($con, "DELETE FROM `products` WHERE `id`='$id'");
    }
    
    header("location: index.php?removed=1");
}

// UPDATE OPERATION
if(isset($_POST['editproduct'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = $_POST['price'];
    $desc = mysqli_real_escape_string($con, $_POST['desc']);

    if($_FILES['image']['name'] != "") {
        // User uploaded a NEW image
        $img_name = time() . "_" . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // 1. Delete old image from server
        $res = mysqli_query($con, "SELECT `image` FROM `products` WHERE `id`='$id'");
        $old_img = mysqli_fetch_assoc($res)['image'];
        unlink(UPLOAD_SRC . $old_img);

        // 2. Upload new image
        move_uploaded_file($tmp_name, UPLOAD_SRC . $img_name);

        // 3. Update DB with new image name
        $update_query = "UPDATE `products` SET `name`='$name', `price`='$price', `description`='$desc', `image`='$img_name' WHERE `id`='$id'";
    } else {
        // User did NOT upload a new image, keep the old one
        $update_query = "UPDATE `products` SET `name`='$name', `price`='$price', `description`='$desc' WHERE `id`='$id'";
    }

    if(mysqli_query($con, $update_query)) {
        header("location: index.php?update=success");
    } else {
        header("location: index.php?update=error");
    }
}
?>