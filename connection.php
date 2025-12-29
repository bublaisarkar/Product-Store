<?php
$con = mysqli_connect("localhost", "root", "", "crud");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Absolute path for server-side file operations
define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/Product-Store/uploads/");

// Web path for displaying images in <img> tags
define("FETCH_SRC", "http://localhost/Product-Store/uploads/");
?>