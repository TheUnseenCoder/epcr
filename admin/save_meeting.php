<?php
session_start();
include '../database.php';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['meetingDescription']) && isset($_POST['meetingDate']) && isset($_POST['meetingTime'])) {

        // Escape user inputs for security (Prevent SQL injection)
        $meetingDescription = $conn->real_escape_string($_POST['meetingDescription']);
        $meetingDate = $conn->real_escape_string($_POST['meetingDate']);
        $meetingTime = $conn->real_escape_string($_POST['meetingTime']);
        
        $email = $_SESSION['email'];
        $mail = $conn->prepare("SELECT * FROM epcr_adminusers WHERE email = ?");
        $mail->bind_param("s", $email);
        $mail->execute();
        $mailres = $mail->get_result();

        if ($mailres->num_rows > 0) {
            $row1 = $mailres->fetch_assoc();
            $fullname = $row1['fullname'];
        } else {
            echo "User not found.";
            exit;
        }
        // Get the complaint ID from the URL
        $complaint_id = $_GET['id'];
        // Update the epcr_user_complaint table with the meeting data
        $sql = "UPDATE epcr_user_complaints SET status='on schedule', meet_desc = '$meetingDescription', meeting_date = '$meetingDate', meeting_time = '$meetingTime', meeting_setter='$fullname' WHERE complaint_id = '$complaint_id'";

        if ($conn->query($sql) === TRUE) {

            // Fetch complaint details
            $selector = "SELECT * FROM epcr_user_complaints WHERE complaint_id = $complaint_id";
            $res = $conn->query($selector);

            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                // Fetch complaint details
                $compliant = $row['name'];
                $complaint = $row['complaints'];
                $category_id = $row['category_id'];
                $date = $row['date_submitted'];
                $formatted_date = date("F d, Y", strtotime($date));
                $meeting_date_formatted = date("F d, Y", strtotime($row['meeting_date']));
                $meeting_time_formatted = date("h:i A", strtotime($row['meeting_time']));
                $desc = $meeting_date_formatted . " " . $meeting_time_formatted;

                // Map category ID to category name
                switch ($category_id) {
                    case 1:
                        $category = "Sanitation";
                        break;
                    case 2:
                        $category = "Security";
                        break;
                    case 3:
                        $category = "Infrastructure";
                        break;
                    case 4:
                        $category = "Neighbor Concern";
                        break;
                    default:
                        $category = "Other Concern";
                        break;
                }

                // Construct action message
                $acres = "Changed the complaint status to 'On Schedule' for the complaint submitted by $compliant about $category, which was submitted on $formatted_date. The meeting was set on $desc.";

                // Insert log entry
                $user_type = $_SESSION['user_type'];
                $logs = $conn->prepare("INSERT INTO epcr_logs SET fullname = ?, position = ?, compliant = ?, complaint = ?, complaint_id = ?, action = ?");
                $logs->bind_param("ssssis", $fullname, $user_type, $compliant, $complaint, $complaint_id, $acres);
                if ($logs->execute()) {
                    echo "Meeting Created Successfully";

                    $logs->close();
                } else {
                    echo "Error creating meeting: " . $conn->error;
                }
            } else {
                // Output more details about the issue
                echo "Complaint not found. SQL: $selector Error: " . $conn->error;
            }
        } else {
            echo "Error updating complaint: " . $conn->error;
        }
        $mail->close();

        // Close connection
        $conn->close();
    } else {
        // Handle missing fields error
        echo "All fields are required!";
    }
} else {
    // Handle non-POST request error
    echo "Invalid request method!";
}
?>
