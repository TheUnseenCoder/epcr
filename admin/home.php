<?php
include '../database.php';
include '../admin/count.php';

$total = $totalSanitationCount + $totalInfrastracture + $neigboir_concern + $security + $emergency;
$percentageSanitation = ($totalSanitationCount / $total) * 100;
$percentageInfrastructure = ($totalInfrastracture / $total) * 100;
$percentageNeighborConcerns = ($neigboir_concern / $total) * 100;
$percentageSecurity = ($security / $total) * 100;
$percentageEmergency = ($emergency / $total) * 100;
$percentageOtherConcerns = ($otherconcerns / $total) * 100;
$percentageResolved = ($resolvedCount / $total) * 100;
$percentageUnresolved = (($total - $resolvedCount) / $total) * 100;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>EPCR | Home</title>
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

  <!--  Main wrapper -->
  <div class="body-wrapper">

  <?php include '../admin/components/header.php'; ?>
  &nbsp;
    <div class="container-fluid">

    <?php
 
$dataPoints = array( 
	array("label"=>"Sanitation", "y"=>$percentageSanitation),
	array("label"=>"Infrastructure", "y"=>$percentageInfrastructure),
	array("label"=>"Neighbor Concerns", "y"=>$percentageNeighborConcerns),
	array("label"=>"Security", "y"=>$percentageSecurity ),
	array("label"=>"Other Concerns", "y"=>$percentageOtherConcerns ),
  array("label"=>"Total of Resolved Complaints", "y"=>$percentageResolved),
  array("label"=>"Total of UnResolved Complaints", "y"=>$percentageUnresolved),

)
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: " Percentage of Complaints"
	},
	axisY: {
		title: "Percentages",
    suffix: "%"
	},
	data: [{

		yValueFormatString: "#,##0.00\"%\"",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>       