<?php
// Include the database connection file
include '../database.php';

// Check if the complaint ID is provided in the POST data
if (isset($_POST['complaint_id'])) {
    // Sanitize the complaint ID
    $complaint_id = $_POST['complaint_id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM epcr_user_complaints WHERE complaint_id = ?");
    $stmt->bind_param('i', $complaint_id);

    // Execute the delete statement
    if ($stmt->execute()) {
        // Redirect back to the previous page after successful deletion
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Handle error if deletion fails
        echo "Error deleting record: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
