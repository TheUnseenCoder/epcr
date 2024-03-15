<?php
include "conn.php";

// Check if the required parameters are provided
if (isset($_POST['email']) && isset($_POST['address']) && isset($_POST['mobile'])) {
    
    // Retrieve the email, address, and mobile from POST parameters
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    
    // Perform the database update here
    // Assuming you have a database connection already established
    
    // Example SQL query to update the user's profile
    $sql = "UPDATE epcr_users SET address = '$address', mobile_number = '$mobile' WHERE email = '$email'";
    
    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Profile updated successfully
        echo "success";
    } else {
        // Error updating profile
        echo "error";
    }
    
} else {
    // Required parameters are missing
    echo "missing_parameters";
}
?>
