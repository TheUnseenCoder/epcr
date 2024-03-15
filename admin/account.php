
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>BMS | Account</title>
  <link rel="icon" href="../assets/images/logo.png"/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/main.css"/>
  <link rel="stylesheet" href="../assets/css/bootstrap.css"/>

</head>

<body>

<?php include '../admin/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../admin/components/header.php'; ?>

      <div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
            <div class="d-flex">
              <h5 class="card-title fw-semibold mb-4">Account Registration</h5>
              <div class="flex-grow-1"></div>
            </div>
            
          <form action="register.php" method="post">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="text" class="form-label">Fullname</label>
                  <input type="text" name="fullname" class="form-control" id="name" placeholder="Enter your name" required>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="text" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="text" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter your Password" required>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label for="" class="form-label">Confirm Password</label>
                  <input type="password"  name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Enter your Password" required>
                </div>
              </div>
            </div>
            <div class="input_field">
               <label for="" class="form-label"> ROLE  </label> &nbsp;
               <select class="input" name="user_type">
                  <option> Choose </option>
                  <option> STAFF </option>
                  <option> ADMIN </option>
         </select>
   </div>
              <div class="input-box-button text-center mt-3">
                <button type="submit" name="submit" class="btn btn-primary w-45"> Register Now
                </button>
              </div>
            </form>
           
            <!-- <div class="wrapper">
              <form action="" method="post">
                <div class="signup">
                    <div class="details personal">
                    <div class="input-box">
                      <input type="text" name="fullname" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                      <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                      <input type="password" name="password" placeholder="Create password" required>
                    </div>
                    <div class="input-box">
                      <input type="password" name="confirmpassword" placeholder="Confirm password" required>
                    </div>
              
                <div class="input-box button">
                  <input type="submit" name="submit" value="Register Now">
                </div> -->
              
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>





  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

 

</body>
</html>