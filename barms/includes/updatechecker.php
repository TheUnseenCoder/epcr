<?php
include "conn.php";

if(isset($_POST['email'])) {
    $email = $_POST['email'];

    // Select user data from the database
    $sql = "SELECT email, fullname, address, mobile_number, profile FROM epcr_users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = array(
                "status" => "success",
                "email" => $row['email'],
                "fullname" => $row['fullname'],
                "address" => $row['address'],
                "mobile" => $row['mobile_number'],
                "profile" => base64_encode($row['profile']) // Encode profile image to base64
            );
            echo json_encode($response);
        } else {
            $response = array("status" => "error", "message" => "User not found");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => $conn->error);
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Email not provided");
    echo json_encode($response);
}

$conn->close();
?>
