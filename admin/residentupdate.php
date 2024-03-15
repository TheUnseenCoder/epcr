<?php

include '../database.php';


if(isset($_POST['updateid'])){

   $user_id=$_POST['updateid'];

   $sql="Select * from `epcr_residents` where id=$user_id";
   $result=mysqli_query($conn,$sql);
   $response=array();
   while($row=mysqli_fetch_assoc($result)){
         $response=$row;
   }
      echo json_encode($response);
   }else{
      $response['status']=200;
      $response['message']="INVALID OR DATA NOT FOUND";

   }
   
   // update query

   if(isset($_POST['hiddendata'])){
      $unique=$_POST['hiddendata'];
      $name=$_POST['updatename'];
      $address=$_POST['updateaddress'];
      $email=$_POST['updateemail'];
      $number=$_POST['updatenumber'];
      

      $sql="update  `epcr_residents` set name='$name', address='$address', email='$email', number='$number' where id=$unique";

      $result=mysqli_query($conn,$sql);

      

   }





?>