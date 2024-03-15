<?php include '../database.php';?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>BMS | LIST OF RESIDENTS</title>
  <link rel="icon" href="../assets/images/logo.png"/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

  <!-- Main Template -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/main.css"/>
  <link rel="stylesheet" href="../assets/css/bootstrap.css"/>

</head>

<style>
    .btn-info {
        background-color: #ffa351;
        border-color: #ffa351;
    }
    .btn-info:hover {
        background-color: #ff9143;
        border-color: #ff9143;
    }
    .btn-dark {
        background-color: #ffa351;
        border-color: #ffa351;
    }
    .btn-dark:hover {
        background-color: #ff9143;
        border-color: #ff9143;
    }
</style>

<body>

<?php include '../admin/components/staffnav.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../admin/components/header.php'; ?>

    <div class="container-fluid ">
    <center> <h5 class="card-title fw-semibold mb-4"> LIST OF RESIDENTS</h5> </center>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#completeModal">
            ADD RESIDENTS </button>
            <div class="flex-grow-1"></div>
            <br><br>
    <div id="displayDataTable"> </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD RESIDENTS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" autocomplete="off"required>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea name="address" id="address" cols="20" rows="4" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" autocomplete="off"required>
  </div>
  <div class="form-group">
    <label for="number">Contact Number</label>
    <input type="text" class="form-control" id="number" autocomplete="off"required>
  </div>
  
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-info" onclick="adduser()">Submit </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="updatename" autocomplete="off"required>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea name="address" id="updateaddress" cols="20" rows="4" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="updateemail" autocomplete="off"required>
  </div>
  <div class="form-group">
    <label for="number">Contact Number</label>
    <input type="text" class="form-control" id="updatenumber" autocomplete="off"required>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



  <script>

// display function
$(document).ready(function(){ 
    displayData(); 
}); 
function displayData(){
    var displayData="true";
    $.ajax({
        url: "../admin/residentdisplay.php",
        type: 'post',
        data: {
            displaySend: displayData
        },
        success:function(data,status){
            $('#displayDataTable').html(data);

        }

    });
}
function adduser(){
    var name=$('#name').val();
    var address=$('#address').val();
    var email=$('#email').val();
    var number=$('#number').val();



    $.ajax({
        url:"../admin/residentinsert.php",
        type:'post',
        data:{
            name:name,
            address:address,
            email:email,
            number:number     
          },
        success:function(data,status){
         // Clear input fields after successful submission
         $('#name').val('');
            $('#address').val('');
            $('#email').val('');
            $('#number').val('');

            // Hide the modal
            $('#completeModal').modal('hide');

            // Refresh data display
            displayData();
        }
    });
}


    function DeleteUser(deleteid){
          $.ajax({
                url:"../admin/residentdelete.php",
                type: 'post',
                data:{
                    deletesend:deleteid
                },
                success:function(data,status){
                displayData();
                }
            });
        }


        // Update
    function GetDetails(updateid) {
    $('#hiddendata').val(updateid);

    $.post("../admin/residentupdate.php", { updateid: updateid }, function(data, status) {
        var userid = JSON.parse(data);
        $('#updatename').val(userid.name);
        $('#updateaddress').val(userid.address);
        $('#updateemail').val(userid.email);
        $('#updatenumber').val(userid.number);

        // Show the update modal after data is fetched and filled
        $('#updateModal').modal("show");
    });
}

    // onclick update event function
    function updateDetails() {
        var updatename = $('#updatename').val();
        var updateaddress = $('#updateaddress').val();
        var updateemail = $('#updateemail').val();
        var updatenumber = $('#updatenumber').val();
        var hiddendata = $('#hiddendata').val();

        $.post("../admin/residentupdate.php", {
            updatename: updatename,
            updateaddress: updateaddress,
            updateemail: updateemail,
            updatenumber: updatenumber,
            hiddendata: hiddendata
        }, function(data, status) {
            // Hide the modal after updating data
            $('#updateModal').modal('hide');
            
            // Call the displayData function to refresh the displayed data
            displayData();
            
        });
    }
  
</script>

</body>
</html>
