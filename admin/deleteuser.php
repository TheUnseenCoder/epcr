<?php 
include '../database.php';

 if(isset($_POST['delete']))
 {
    $full_name= $_POST['fullname'];
    $sql= "DELETE FROM epcr_adminusers WHERE fullname='$full_name' ";
    $result=mysqli_query($conn, $sql);

    if($result)
    {
        echo '<script>alert ("Data Deleted"); </script>';
        echo "<script>location.replace('../admin/register-account.php') </script>";
    }
    else
    {
        echo '<script>alert ("Data Not Deleted"); </script>';
    }
 }
 ?>