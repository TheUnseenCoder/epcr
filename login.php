<?php

if (isset($_SESSION["user"])) {
  header("Location: ./admin/home.php");
}

$error = isset($_GET['error']) ? $_GET['error'] : "0";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> LOG IN FORM</title>

  <link rel="icon" href="./assets/images/logo.png"/>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./assets/css/login.css"/>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">


</head>

<div class="btnbacklogin">
        <a href="index.php">
      <button>BACK</button> 
        </a> 
    </div>

<body>

	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
            <form action="login_qry.php" method="post">
			<div class="signup">
                
            <form>
         <center>    <img src="./assets/images/logo.png" width="230" alt="logo" class="image" > </center>
         <h6 style="color: white;">
         <?php
if ($error == "1") {
    echo "<script>alert('Wrong password');</script>";
} elseif ($error == "2") {
    echo "<script>alert('Invalid username or password');</script>";
} elseif ($error == "3") {
    echo "<script>alert('Your Account is Deactivated');</script>";
}
?></h6>
        <div class="form-group">
            <h1> EMAIL: </h1>
            <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
        <h1> PASSWORD: </h1>
            <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
        </div>
    </div>
    
      <button type="submit" value="Login" name="submit"> LOG IN </button>  
     </form>
    </div>
    </div>

 <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
 <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
 
</body>

</html>
