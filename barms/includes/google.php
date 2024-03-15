<?php
include "conn.php";
// Get data from POST request
if(isset($_POST['email']) && isset($_POST['fullname'])){
    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

    // Check if email already exists
    $checkQuery = "SELECT * FROM epcr_users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if(mysqli_num_rows($checkResult) > 0){
        echo "The email is already in use!";
    } else {
        // Insert data into database
        $insertQuery = "INSERT INTO epcr_users (email, fullname) VALUES ('$email', '$fullname')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "success";
        } else {
            echo "Error inserting data into the database: " . mysqli_error($conn);
        }
    }
} else {
    echo "No email or fullname received";
}
?>
