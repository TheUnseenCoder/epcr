<?php

include '../database.php';
 

if(isset($_POST['deletesend'])){
	$unique=$_POST['deletesend'];

	$sql="delete from `epcr_residents` where id=$unique";
	$result=mysqli_query($conn,$sql);


}


?>