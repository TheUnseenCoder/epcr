<?php

include '../database.php';

if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['number'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);

    $sql = "INSERT INTO `epcr_residents` (name, address, email, number) VALUES ('$name', '$address', '$email', '$number')";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
?>