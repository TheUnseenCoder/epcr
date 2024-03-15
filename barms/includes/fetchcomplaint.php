<?php
include('conn.php');

// Check if email parameter is set
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Select user ID for the given email
    $query_user_id = "SELECT id FROM epcr_users WHERE email = '$email'";
    $result_user_id = mysqli_query($conn, $query_user_id);

    if($result_user_id) {
        $row_user_id = mysqli_fetch_assoc($result_user_id);
        $user_id = $row_user_id['id'];

        // Select complaints for the given user ID
        $query_complaints = "SELECT * FROM epcr_user_complaints WHERE user_id = '$user_id'";
        $result_complaints = mysqli_query($conn, $query_complaints);

        if(mysqli_num_rows($result_complaints) > 0){
            // Array to hold complaints
            $complaints = array();

            // Fetch and add each complaint to the array
            while($row = mysqli_fetch_assoc($result_complaints)){
                $complaint = array(
                    'category_id' => $row['category_id'],
                    'complaint' => $row['complaints'],
                    'status' => $row['status'],
                    'date_submitted' => $row['date_submitted']
                );
                $complaints[] = $complaint;
            }

            // Send the array of complaints as JSON
            echo json_encode($complaints);
        } else {
            // No complaints found for the given user ID
            echo json_encode(array('error' => 'No complaints found'));
        }
    } else {
        // Error executing the user ID query
        echo json_encode(array('error' => 'Error executing the user ID query: ' . mysqli_error($conn)));
    }
} else {
    // Email parameter is missing
    echo json_encode(array('error' => 'Required parameters are missing'));
}
?>
