<?php
include '../database.php';

if (isset($_POST["submit"])) {
    $fullname = htmlspecialchars($_POST["fullname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST['password'];
    $confirmpassword = $_POST["confirmpassword"];
    $user_type = $_POST['user_type'];

    // Validate inputs
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo "Please fill in all fields.";
    } else {
        // Check for existing user
        $duplicate = mysqli_prepare($conn, "SELECT * FROM epcr_adminusers WHERE fullname = ? OR email = ?");
        mysqli_stmt_bind_param($duplicate, "ss", $fullname, $email);
        mysqli_stmt_execute($duplicate);
        mysqli_stmt_store_result($duplicate);

        if (mysqli_stmt_num_rows($duplicate) > 0) {
      
            echo "<script> alert('Name or Email has already been taken.'); </script>";
                    echo "<script>window.location.href = 'account.php';</script>"; // Redirect using JavaScript
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            if (password_verify($confirmpassword, $hashed_password)) {
                // Set default value for active status
                $status = 1;

                // Insert new user with active status
                $query = "INSERT INTO epcr_adminusers (fullname, email, password, user_type, status) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
               if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssi", $fullname, $email, $hashed_password, $user_type, $status);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script> alert('Registration successful.'); </script>";
                        echo "<script>window.location.href = 'account.php';</script>"; // Redirect using JavaScript
                    } else {
                        echo "<script> alert('Error in Registration: " . mysqli_error($conn) . "'); </script>";
                        echo "<script>window.location.href = 'account.php';</script>"; // Redirect using JavaScript
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "<script> alert('Error in preparing statement: " . mysqli_error($conn) . "'); </script>";
                    echo "<script>window.location.href = 'account.php';</script>"; // Redirect using JavaScript
                }
            } else {
                echo "<script> alert(' Password do not match.'); </script>";
                echo "<script>window.location.href = 'account.php';</script>"; // Redirect using JavaScript
            }
        }
    }
}
?>
