
<link rel="stylesheet" href="bootstrap/bootstrap.css">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


	<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">


                <?php

include '../database.php';

if(isset($_POST['displaySend'])){
    $table='<table id="datatableid" class="table table-hover">
    <thead class="thead-dark">
    <tr>
     <th scope="col"> ID </th>
     <th scope="col"><center> Name of Resident</center> </th>
     <th scope="col"> <center>Address  </center></th>
     <th scope="col"><center>Email Address</center></th> 
      <th scope="col"> Contact Number </th>
      <th scope="col">Operations </th>
    </tr>
  </thead>';

    $sql="Select * from `epcr_residents` ";
    $result=mysqli_query($conn,$sql);
    $number=1;
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        
        $name=$row['name'];
        $address=$row['address'];
        $email=$row['email'];
        $number=$row['number'];   
        $table.='<tr>
        <td scope="row">'.$id.'</td>
        <td>'.$name.'</td>
        <td>'.$address.'</td>
        <td>'.$email.'</td>
        <td>'.$number.'</td>
        <td>
        <button class="btn btn-info"onclick="GetDetails('.$id.')">Update</button>
        <br>
        <br>
        <button class="btn btn-danger"onclick="DeleteUser('.$id.')">Delete</button>
       </td>   
  </tr> '; 
    $number++;
    }
    $table.='</table>';
    echo $table;


}

?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>




<script>
    $(document).ready(function () {

    $('#datatableid').DataTable({
        "pagingType": "full_numbers",
        "lenghtMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]

        ],
        responsive: true,
        language:{
            search:"_INPUT_",
            searchPlaceholder:"Search Records",
        }
    });
});


</script>
</body>

<!-- BOOTSTRAP ANIMATION -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>