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
    <!-- Main wrapper -->
    <div class="body-wrapper">
        <?php include '../admin/components/header.php'; ?>
        <div class="container-fluid">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <h5 class="card-title fw-semibold mb-4">Registered Account</h5>
                        <div class="flex-grow-1"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-left">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-left">Full Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-left">Email</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-left">USERTYPE</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-left">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 0;
                                $sql = "SELECT * FROM `epcr_adminusers`";
                                $result = mysqli_query($conn, $sql);
                                $fetch = $result->fetch_all(MYSQLI_ASSOC);

                                foreach ($fetch as $key => $row) {
                                    $num++;
                                    ?>
                                    <tr>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $num; ?></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['fullname']; ?></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['email']; ?></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['user_type']; ?></h6></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                echo '<p><a href="active.php?id=' . $row['id'] . '&status=0" class="btn btn-success">Active</a></p>';
                                            } else {
                                                echo '<p><a href="active.php?id=' . $row['id'] . '&status=1" class="btn btn-danger">Inactive</a></p>';
                                            }
                                            ?>
                                        </td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">
                                            <!-- <form action="useredit.php" method="post">
                                                <div class="update">
                                                    <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                                    <button type="submit" class="btn btn-info">Edit</button>
                                                </div>
                                            </form> -->
                                            <form action="./deleteuser.php" method="post">
                                                <input type="hidden" name="fullname" value="<?php echo $row['fullname'] ?>">
                                            </form>
                                        </h6></td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
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
