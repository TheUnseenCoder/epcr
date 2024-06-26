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
                    List of <?= ucfirst($_GET['f']) ?> Complaints
                    <button type="button" class="btn btn-primary float-end" onclick="printReport()"><i class="fas fa-print"></i> Print Report</button>
                </h4>
            </div>
            <div id="printable" class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="complaintsTable">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Name of Complainant</th>
                                <th>Address</th>
                                <th>Date Submitted</th>
                                <th>Time Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            $concern = ucfirst($_GET['f']);
                            $stmt = $conn->prepare("SELECT *, u.complaint_id as row_id FROM epcr_user_complaints u 
                            LEFT JOIN epcr_users s ON s.id = u.user_id 
                            LEFT JOIN epcr_category c ON c.category_id = u.category_id 
                            WHERE u.status = 'resolved' AND c.category_name = ? ");
                            $stmt->bind_param("s", $concern);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            if ($result->num_rows > 0) {
                                foreach ($result as $row) {
                                    $num++;
                                ?>
                                    <tr>
                                        <td><?= $num;?></td>
                                        <td><?= $row['fullname'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= date('F d, Y', strtotime($row['date_submitted'])) ?></td>
                                        <td><?= date('h:i A', strtotime($row['date_submitted'])) ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="view-details1.php?id=<?= $row['complaint_id'] ?>"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<td colspan='6' class='text-center'>No Data Found</td>";
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
<script>
    function printReport() {
        var printableTable = document.getElementById("complaintsTable").cloneNode(true);
        printableTable.style.width = '100%';
        printableTable.style.borderCollapse = 'collapse';
        printableTable.style.marginTop = '20px';
        printableTable.style.fontSize = '14px';
        var headers = printableTable.getElementsByTagName('th');
        for (var i = 0; i < headers.length; i++) {
            headers[i].style.backgroundColor = '#f2f2f2';
            headers[i].style.border = '1px solid #dddddd';
            headers[i].style.padding = '10px';
            headers[i].style.textAlign = 'left';
        }
        var cells = printableTable.getElementsByTagName('td');
        for (var i = 0; i < cells.length; i++) {
            cells[i].style.border = '1px solid #dddddd';
            cells[i].style.padding = '10px';
        }

        var printWindow = window.open('', '_blank');
        printWindow.document.body.appendChild(printableTable);
        printWindow.print();
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>
</html>