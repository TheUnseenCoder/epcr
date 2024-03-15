<?php include '../database.php';?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>EPCR | Complaint</title>
  <link rel="icon" href="../assets/images/logo.png"/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/main.css"/>
  <link rel="stylesheet" href="../assets/css/bootstrap.css"/>

</head>

<body>

<?php include '../admin/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

  <?php include '../admin/components/header.php'; ?>
<br>
<center>
    <div class="container mt-5 py-3">
        <div class="card">
            <div class="card-header">
                <h4>
                    Complaint Meetings
                </h4>
            </div>
            <div id="printable" class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="complaintsTable">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Compliant</th>
                                <th>Category</th>
                                <th>Complaint Date</th>
                                <th>Meeting Setter</th>
                                <th>Meeting Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            $sql = "SELECT * FROM epcr_user_complaints WHERE status = 'on schedule' ORDER BY meeting_date ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                foreach ($result as $row) {
                                    $num++;
                                    $meeting_date_formatted = date("F d, Y", strtotime($row['meeting_date']));
                                    $meeting_time_formatted = date("h:i A", strtotime($row['meeting_time']));
                                    $date_submitted = date("F d, Y h:i A", strtotime($row['date_submitted']));
                                    $desc = $meeting_date_formatted . " " . $meeting_time_formatted;
                                    $category_id = $row['category_id'];

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
                                ?>
                                    <tr>
                                        <td><?= $num;?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $category; ?></td>
                                        <td><?= $date_submitted; ?></td>
                                        <td><?= $row['meeting_setter'] ?></td>
                                        <td><?= $desc; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<td colspan='6' class='text-center'>No Logs Found</td>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</center>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>
</html>