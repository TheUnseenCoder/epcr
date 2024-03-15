<?php

include '../database.php';

if(isset($_POST['meetingDescription']) && isset($_POST['meetingDate']) && isset($_POST['meetingTime'])){

    $meetingDescription = mysqli_real_escape_string($conn, $_POST['meetingDescription']);
    $meetingDate = mysqli_real_escape_string($conn, $_POST['meetingDate']);
    $meetingTime = mysqli_real_escape_string($conn, $_POST['meetingTime']);
    
    $sql = "INSERT INTO `epcr_user_complaints` (meetingDescription, meetingDate, meetingTime,) VALUES ('$meetingDescription', '$meetingDate', '$meetingTime')";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
?>