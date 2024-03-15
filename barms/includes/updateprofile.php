<?php
include "conn.php";

if(isset($_POST['email']) && isset($_POST['profile'])) {
    $email = $_POST['email'];
    $profile = $_POST['profile'];

    // Decode the base64-encoded profile image
    $decodedProfile = base64_decode($profile);

    // Update the profile image for the user with the given email
    $sql = "UPDATE epcr_users SET profile = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $decodedProfile, $email);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo $conn->error;
    } 
} else {
    echo "Missing email or profile data";
}

$stmt->close();
$conn->close();
?>
