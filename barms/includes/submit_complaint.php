<?php
include('conn.php');

// Get data from POST request
if(isset($_POST['email']) && isset($_POST['complaints']) && isset($_POST['category_id'])){

    $email = $_POST['email'];
    $complaints = $_POST['complaints'];
    $category_id = $_POST['category_id'];

    // Check if photo and video data are set
    if(isset($_POST['photo']) && isset($_POST['video'])){
        $photo = base64_decode($_POST['photo']);
        $video = base64_decode($_POST['video']);

        // Check if decoding was successful
        if ($photo === false || $video === false) {
            echo json_encode(array("status" => "Error: Failed to decode photo or video"));
            exit();
        }
    } else {
        // If photo or video data is not set, set them to empty strings
        $photo = '';
        $video = '';
    }

    // Escape special characters in the string variables
    $email = mysqli_real_escape_string($conn, $email);
    $complaints = mysqli_real_escape_string($conn, $complaints);
    $category_id = mysqli_real_escape_string($conn, $category_id);

    // Retrieve user's name and ID based on email
    $sql = "SELECT id, fullname FROM epcr_users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['id'];
        $userName = $row['fullname'];

        // Check if the user already has a pending complaint
        $checkSql = "SELECT * FROM epcr_user_complaints WHERE user_id = '$userId' AND (status = 'received/checking' OR status = 'On-going' OR status = 'on schedule')";
        $checkResult = $conn->query($checkSql);

        if($checkResult->num_rows > 0){
            echo json_encode(array("status" => "You still have a pending complaint"));
        }else{
            $insertSql = "INSERT INTO epcr_user_complaints (user_id, name, category_id, complaints, photo, video) VALUES ('$userId', '$userName', '$category_id', '$complaints', ?, ?)";

            // Prepare statement
            $stmt = $conn->prepare($insertSql);

            // Bind parameters
            $stmt->bind_param("ss", $photo, $video);

            // Execute statement
            if ($stmt->execute()) {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "Error: " . $conn->error));
            }
        }
    } else {
        echo json_encode(array("status" => "Error: No user found with the provided email"));
    }

    // Close connection
    $conn->close();
} else {
    echo json_encode(array("status" => "Error: Required parameters are missing"));
}
?>
