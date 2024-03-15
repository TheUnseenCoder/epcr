<?php
session_start();
require 'database.php';

if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $result = mysqli_query($conn, "SELECT * FROM epcr_adminusers WHERE email = '$email'");
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row && password_verify($_POST['password'], $row['password'])) {
            if ($row['status'] == 1) { // Check the user status
                if ($row['user_type'] == 'ADMIN') {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_type'] = "Administrator";
                    header("Location: ./admin/home.php");
                } elseif ($row['user_type'] == 'STAFF') {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_type'] = "Staff";
                    header("Location: ./admin/staff.php");
                }
                // Set $_SESSION['id'] somewhere before using it
                $_SESSION['id'] = $row['id'];
                $sql = "UPDATE epcr_adminusers SET lastactivity = NOW() WHERE id=" . $_SESSION['id'];
                $result = mysqli_query($conn, $sql);
            } else {
                // User is deactivated, redirect with error message
                header("Location: index.php?error=3");
                exit();
            }
        } else {
            // Redirect with error message
            header("Location: index.php?error=2");
            exit();
        }
    } else {
        // Handle query error
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>
