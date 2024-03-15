<?php
include '../database.php';

$id = $_GET['id'];
$status = $_GET['status'];

$updateQuery ="UPDATE epcr_adminusers SET status=$status WHERE id=$id";

mysqli_query($conn, $updateQuery);
header('location:register-account.php');
?>