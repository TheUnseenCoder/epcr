<?php include '../database.php'; 
session_start();?>
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
// Assuming $conn is your database connection object
$email = $_SESSION['email'];
$user_type = $_SESSION['user_type'];
// Retrieving a specific complaint based on complaint ID
$complaint_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM epcr_user_complaints WHERE complaint_id = ?");
$stmt->bind_param('i', $complaint_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Loop through the results
    foreach ($result as $row) {

        // Get the category concern

        // Retrieving related complaints based on category concern
        $stmt = $conn->prepare("SELECT *, u.status AS complaint_status, u.complaint_id AS row_id 
                                FROM epcr_user_complaints u 
                                LEFT JOIN epcr_users s ON s.id = u.user_id 
                                LEFT JOIN epcr_category c ON c.category_id = u.category_id 
                                WHERE u.status != 'resolved' AND c.category_name = ?");
        $stmt->bind_param("s", $concern);
        $stmt->execute();
        $related_complaints_result = $stmt->get_result();

        // Now you can work with $related_complaints_result
        // For example, you can loop through it to display related complaints
        if ($related_complaints_result->num_rows > 0) {
            foreach ($related_complaints_result as $related_row) {
                // Do something with each related complaint
            }
        } else {
            // No related complaints found
        }
    }
} else {
    // No complaints found for the given ID
}
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
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal">
   &nbsp;&nbsp;&nbsp;&nbsp; View Image &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal">
    &nbsp;&nbsp;&nbsp;&nbsp;View Video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </button>
    <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
   
<button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-primary btn-sm on_going">Mark as On Going</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#meetingModal">
    &nbsp;&nbsp;&nbsp;Set Meeting&nbsp;&nbsp;&nbsp;&nbsp;
    </button>
    <br>
    <br>

    <?php
// Assuming $conn is your database connection object

// Retrieving a specific complaint based on complaint ID
$complaint_id = $_GET['id'] ?? null;

if ($complaint_id !== null) {
    $stmt = $conn->prepare("SELECT * FROM epcr_user_complaints WHERE complaint_id = ?");
    $stmt->bind_param('i', $complaint_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the complaint
        $row = $result->fetch_assoc(); 
        // Render the "Mark as Resolved" button based on complaint status
        $resolvedButtonDisabled = ($row['status'] !== 'received/checking') ? 'enable' : '';
        $resolvedButtonEnable = ($row['status'] !== 'On-going') ? 'disabled' : '';
        ?>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-success btn-sm resolved" <?= $resolvedButtonEnable ?> <?= $resolvedButtonDisabled ?>>Mark as Resolved</button>
        <?php
    } else {
        // No complaints found for the given ID
    }
} else {
    // Handle case where no complaint ID is provided
}
?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" data-id="<?= $row['complaint_id'] ?>" class="btn btn-danger btn-sm declined">Mark as Declined</button>

</h6></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<!-- Set Meeting Modal -->
<div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingModalLabel">List of Set Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="meetingForm">
                    <div class="mb-3">
                        <label for="meetingDescription" class="form-label">Meeting Description</label>
                        <textarea class="form-control" id="meetingDescription" name="meetingDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="meetingDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="meetingDate" name="meetingDate">
                    </div>
                    <div class="mb-3">
                        <label for="meetingTime" class="form-label">Time</label>
                        <input type="time" class="form-control" id="meetingTime" name="meetingTime">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitMeeting()">Set Meeting</button>
                </form>
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
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($photo) . '" />';
                } else {
                    echo "No image available.";
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
                    echo '<video controls class="img-fluid">';
                    echo '<source src="data:video/mp4;base64,' . base64_encode($video) . '" type="video/mp4">';
                    echo 'Your browser does not support the video tag.';
                    echo '</video>';
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
       
        </div>

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

    $('.declined').on('click',function(){
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
                            action: 'declined'
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

<script>
function submitMeeting() {
    // Serialize form data
    var formData = $('#meetingForm').serialize();
    var urlParams = new URLSearchParams(window.location.search);
    var complaintId = urlParams.get('id');

$.ajax({
    type: "POST",
    url: './save_meeting.php?id=' + complaintId, // Pass the complaint ID in the URL
    data: formData,
    success: function (response) {
        // Handle the response from the server (if needed)
        console.log(response);
        // Close the modal after successful submission
        $('#meetingModal').removeClass('show');
        $('.modal-backdrop').remove();

    },
    error: function (xhr, status, error) {
        // Handle errors (if any)
        console.error("Error:", xhr.responseText);
        alert('An error occurred while saving the meeting data. Please try again later.');
    }
});
}

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