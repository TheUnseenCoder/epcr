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

  <style>
    #imageCarousel .carousel-control-prev-icon,
    #imageCarousel .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
    }

    #imageCarousel .carousel-control-prev,
    #imageCarousel .carousel-control-next {
        width: 5%;
        background-color: transparent; 
    }

    #imageCarousel .carousel-control-prev:hover,
    #imageCarousel .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.1)
    }

    #imageCarousel .carousel-control-prev-icon::before,
    #imageCarousel .carousel-control-next-icon::before {
        color: white;
        font-size: 24px;
    }
</style>
</head>

<body>

<?php include '../admin/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../admin/components/header.php'; ?>
      <div class="container-fluid">
      <div class="container mt-5 py-3 mb-5">
    <div class="card mb-5">
        <div class="card-header">
            <center><h4>
                Complainant Details - Information
                <a class="btn btn-primary float-end" href="javascript:history.go(-1)">Back</a>
            </h4>
</center>
        </div>



        
        <div class="card-body"> 
            <?php
            $complaint_id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM epcr_user_complaints WHERE complaint_id = ?");
            $stmt->bind_param('i', $complaint_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                foreach ($result as $row) {
            ?>
                    <div class="row">
                        <div class="col-md-6 mb-2 mx-auto">
                            <div class="col-md-12 mb-3 mx-auto">
                                <label>Complainant Name</label>
                                <input readonly type="text" value="<?= $row['name'] ?>" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3 mx-auto">
                                <label>Complaint</label>
                                <textarea class="form-control mx-auto" rows="3"><?= $row['complaints'] ?></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mx-auto">
                                        <label>Date Submitted</label>
                                        <input readonly class="form-control mx-auto" value="<?= date('F d, Y', strtotime($row['date_submitted'])) ?>">
                                    </div>
                                    <div class="col-md-6 mb-3 mx-auto">
                                        <label>Time Submitted</label>
                                        <input readonly class="form-control mx-auto" value="<?= date('h:i A', strtotime($row['date_submitted'])) ?>">
                                    </div>

                                    
                    
                                    <td class="border-bottom-5"><h6 class="fw-semibold mb-0">
                                        <br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
   <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal">
        View Image
    </button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal">
        View Video
    </button>
    <br>
    <br>

    <form method="POST" action="delete-complaint.php">
    <input type="hidden" name="complaint_id" value="<?= $row['complaint_id'] ?>">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-danger btn-sm">Delete</button>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-danger btn-sm received/checking">Mark as Retrieved</button>
</form>
</h6></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Attachments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
                $photo = $row['photo'];
                if (!empty($photo)) {
                    header('Content-Type: image/jpeg');
                    echo base64_decode($photo);
                } else {
                    echo "No video available.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Attachments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
                $video = $row['video'];
                if (!empty($video)) {
                    header('Content-Type: video/mp4');
                    echo base64_decode($video);
                } else {
                    echo "No video available.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

                            
                                </div>
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

<script>
     $('.received/checking').on('click',function(){
            var dataId = $(this).data('id')
            console.log(dataId)
            Swal.fire({
                title: "Mark this Complain as Declined?",
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
                            action: 'received/checking'
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
    
        </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>

</body>
</html>