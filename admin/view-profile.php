<?php include '../database.php';?>
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
          <h4>
                Complainant Details - Information
                <a class="btn btn-primary float-end " href="javascript:history.go(-1)">Back</a>
            </h4>
            <div class="d-flex">
              <h5 class="card-title fw-semibold mb-4">User Profile</h5>
              <div class="flex-grow-1"></div>
            </div>
            <div class="card-body">
            <?php
            $userId = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM epcr_users WHERE id = ? ");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                foreach ($result as $row) {
            ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <?php
                                $profile = $row['profile'];
                            if(!empty($profile)){
                              $photo = '<img src="data:image/jpeg;base64,' . base64_encode($profile) . '" style="width: 370px; height: 370px;" />';
                              echo $photo;
                            }else{
                              $photo = '<img src="../assets/images/default_profile.png" style="width: 370px; height: 370px;" />';
                              echo $photo;
                            }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="col-md-12">
                            </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="">Fullname</label>
                                    <input readonly type="text" value="<?= $row['fullname'] ?>" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Email Address</label>
                                    <input readonly type="text" value="<?= $row['email'] ?>" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Address</label>
                                    <input readonly type="text" value="<?= $row['address'] ?>" class="form-control">
                                </div>
                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="view-complains.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">View Complains</a>
                            </td>
                            </div>
                        </div>

                    </div>
            <?php
                }
            }
            ?>
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