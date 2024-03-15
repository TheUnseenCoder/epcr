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

      <div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
            <div class="d-flex">
              <h5 class="card-title fw-semibold mb-4">List of <?= ucfirst($_GET['f']) ?> Complaints</h5>
              <!-- <div class="flex-grow-1"></div>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="ti ti-square-plus fs-3"></i>
                Add Account
              </button> -->
            </div>
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">No</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Name of Complainant</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Address</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Date Submitted</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Time Submitted</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Status</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Action</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                        $num=0;
                        $concern = ucfirst($_GET['f']);
                        $stmt = $conn->prepare("SELECT *, u.status as complaint_status, u.complaint_id as row_id FROM epcr_user_complaints u 
                            LEFT JOIN epcr_users s ON s.id = u.user_id 
                            LEFT JOIN epcr_category c ON c.category_id = u.category_id 
                            WHERE (status = 'received/checking' OR status = 'on schedule' OR status = 'On-going') AND c.category_name = ? ");
                        $stmt->bind_param("s", $concern);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $data = $result->fetch_assoc();
                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                              $num++;
                        ?>
                  <tr>
                  <td><?= $num; ?></td>
                                    <td><?= $row['fullname'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= date('F d, Y', strtotime($row['date_submitted'])) ?></td>
                                    <td><?= date('h:i A', strtotime($row['date_submitted'])) ?></td>
                                    <td><?= $row['complaint_status'] ?></td>
                                    <td>
                                      <center>  <a class="btn btn-info btn-sm" href="../admin/view-details.php?id=<?= $row['complaint_id'] ?>"><i class="fas fa-eye"></i></a> </center>
                                       
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
                        url: '../admin/action/update-complaints.php',
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
                      url: '../admin/action/update-complaints.php',
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