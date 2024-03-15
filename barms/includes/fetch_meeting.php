<?php
// Include database connection
include 'conn.php';

// Check if email parameter is set
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Prepare and execute SQL query to fetch fullname from epcr_user table
    $stmt = $conn->prepare("SELECT fullname FROM epcr_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];

        // Prepare and execute SQL query to fetch meeting details for the given fullname
        $stmt2 = $conn->prepare("SELECT meet_desc, meeting_date, meeting_time, meeting_setter FROM epcr_user_complaints WHERE name = ? AND status = 'on schedule'");
        $stmt2->bind_param("s", $fullname);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        // Check if any rows are returned
        if ($result2->num_rows > 0) {
            // Fetch and return the first row as delimited string
            $row2 = $result2->fetch_assoc();
            $meeting_date_formatted = date("F d, Y", strtotime($row2['meeting_date']));
            $meeting_time_formatted = date("h:i A", strtotime($row2['meeting_time']));
            $desc = $meeting_date_formatted . " " . $meeting_time_formatted;

            echo $row2['meet_desc'] . "|" . $desc . "|" . $row2['meeting_setter'];
        } else {
            // No meeting details found for the given fullname
            echo "No meeting details found";
        }

        // Close prepared statements
        $stmt2->close();
    } else {
        // No user found with the given email
        echo "No user found with the given email";
    }

    // Close prepared statement
    $stmt->close();
} else {
    // Email parameter not set
    echo "Email parameter is missing";
}

// Close database connection
$conn->close();
?>
