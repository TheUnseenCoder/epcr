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

<div class="body-wrapper">

<?php include '../admin/components/header.php'; ?>


<div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
            <div class="d-flex">
              <h5 class="card-title fw-semibold mb-4">List of <?= ucfirst($_GET['f']) ?> Complaints</h5>
              <div class="flex-grow-1"></div>

</div>

<div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Name of Complainant</th>
                            <th>Category</th>
                            <th>Date Submitted</th>
                            <th>Time Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$concern = ucfirst($_GET['f']);
$complaintStatement = $conn->prepare("SELECT *, u.status as complaint_status, u.complaint_id as row_id 
    FROM epcr_user_complaints u 
    LEFT JOIN epcr_category c ON c.category_id = u.category_id 
    WHERE status != 'resolved' AND c.category_name = ? ");
$complaintStatement->bind_param("s", $concern);
$complaintStatement->execute();
$result = $complaintStatement->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

if ($rows) {
    foreach ($rows as $row) {
        ?>
        <tr>
            <td><?= $row['row_id'] ?></td>
            <td><?= $row['fullname'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= date('F d, Y', strtotime($row['date_submitted'])) ?></td>
            <td><?= date('h:i A', strtotime($row['date_submitted'])) ?></td>
            <td><?= $row['complaint_status'] ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="view-details.php?id=<?= $row['complaint_id'] ?>"><i class="fas fa-eye"></i></a>
                <button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-warning btn-sm on_going">Mark as On Going</button> 
                <button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-success btn-sm resolved">Mark as Resolved</button>
            </td>
        </tr>
<?php
    }
} else {
    echo "<td colspan='7' class='text-center'>No Data Found</td>";
}
?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(() => {
        $('.on_going').on('click', function() {
            var dataId = $(this).data('id')
            console.log(dataId)
            Swal.fire({
                title: "Mark this Complain as On-Going?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, proceed"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'action/update-complaints.php',
                        type: 'POST',
                        data: {
                            dataId: dataId,
                            action: 'on-going'
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 1500);
                            }
                        }
                    })

                }
            });
        })
        $('.resolved').on('click',function(){
            var dataId = $(this).data('id')
            console.log(dataId)
            Swal.fire({
                title: "Mark this Complain as Resolved ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, proceed"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'action/update-complaints.php',
                        type: 'POST',
                        data: {
                            dataId: dataId,
                            action: 'resolved'
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success"
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 1500);
                            }
                        }
                    })

                }
            }); 
        })
    })
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

</body>
</html>