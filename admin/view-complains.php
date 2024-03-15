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
<style>
        .complaints-table {
            width: 70%;
            margin: 25px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .complaints-table th,
        .complaints-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .complaints-table th {
            background-color: #ffa351;
            color: white;
        }
    </style>

<body>

<?php include '../admin/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../admin/components/header.php'; ?>

      <div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
          <h4>
          Complains of Complainant
                <a class="btn btn-primary float-end " href="javascript:history.go(-1)">Back</a>
            </h4>
          <section class="complains">
        <table class="complaints-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Complain Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userId = $_GET['id'];
                $i = 1;
                $stmt = $conn->prepare("SELECT *, u.status as complain_status FROM epcr_user_complaints u LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE u.user_id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td><?= $row['complaints'] ?></td>
                            <td><?= $row['complain_status'] ?></td>
                            <td><?= date('F d, Y', strtotime($row['date_submitted'])) ?></td>
                            <td><?= date('h:i A', strtotime($row['date_submitted'])) ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
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