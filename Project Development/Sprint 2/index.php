<?php

include ("connect.php");
$sql = "SELECT MaritalStatus, COUNT(*) FROM dataset WHERE Attrition='Yes' GROUP BY MaritalStatus";

$rs = mysqli_query($con, $sql);

$totalitems = mysqli_num_rows($rs);

if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['MaritalStatus'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints[$i]=$z;
        $i=$i+1;
    }
}

$sql = "SELECT JobRole, COUNT(*) FROM dataset WHERE Attrition='Yes' GROUP BY JobRole";
$rs = mysqli_query($con, $sql);
$totalitems = mysqli_num_rows($rs);
if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['JobRole'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints1[$i]=$z;
        $i=$i+1;
    }
}
 
$sql = "SELECT JobRole, COUNT(*) FROM dataset WHERE Attrition='No' GROUP BY JobRole";
$rs = mysqli_query($con, $sql);
$totalitems = mysqli_num_rows($rs);
if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['JobRole'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints2[$i]=$z;
        $i=$i+1;
    }
}

$sql = "SELECT Department, COUNT(*) FROM dataset WHERE Attrition='Yes' GROUP BY Department";
$rs = mysqli_query($con, $sql);
$totalitems = mysqli_num_rows($rs);
if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['Department'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints1[$i]=$z;
        $i=$i+1;
    }
}
 
$sql = "SELECT Department, COUNT(*) FROM dataset WHERE Attrition='No' GROUP BY Department";
$rs = mysqli_query($con, $sql);
$totalitems = mysqli_num_rows($rs);
if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['Department'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints2[$i]=$z;
        $i=$i+1;
    }
}

$sql = "SELECT EducationField, COUNT(*) FROM dataset WHERE Attrition='Yes' GROUP BY EducationField";
$rs = mysqli_query($con, $sql);
$totalitems = mysqli_num_rows($rs);
if($totalitems > 0)
{
    $i=0;
    while($row = mysqli_fetch_assoc($rs)) {
        $x=$row['EducationField'];
        $y=$row['COUNT(*)'];
        $z=array("label"=>"$x", "y"=>"$y");
        $dataPoints1[$i]=$z;
        $i=$i+1;
    }
}
 
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
  
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}
.column {
  flex: 50%;
  padding: 0 4px;
}
.btn{
    background-color:#dddddd;
    font-weight: bold;
    border: 2px solid black;
}
  </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style="width: 100%">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="logo.png" alt="Logo" height="40px" width="50px" style="margin: 5px;">
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Team Prism - Team ID : PNT2022TMID28131</a></li>
      <li style="margin-left: 700px;"><button type="button" class="btn" onClick="window.location.href='login.html';" style="margin: 8px 8px;">Update</button></li>
    </ul>
  </div>
</nav>

<script>
window.onload = function() {

var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	
	subtitles: [{
		text: "Attrition by Marital Status"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
	subtitles:[ {
		text: "Attrition by Job Role"
	}],
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
    axisX:{
        title: "Job Role"
    },
	axisY: {
		title: "Attrition Count"
	},
	legend: {
		cursor: "pointer"
	},
	data: [
		{
			type: "stackedColumn",
			name: "Attrition-Yes",
			showInLegend: true,
			yValueFormatString: "#,##0 ",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},{
			type: "stackedColumn",
			name: "Attrition-No",
			showInLegend: true,
			yValueFormatString: "#,##0 ",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		},
	]
});
 
chart2.render();

var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	subtitles:[{
		text: "Attrition By Department"
	}],
	axisX:{
		reversed: true
	},
	axisY:{
		includeZero: true
	},
	toolTip:{
		shared: true
	},
    
	data: [{
		type: "stackedBar",
		name: "Attrition-Yes",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "stackedBar",
		name: "Attrition-No",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	},
    
]
});
chart3.render();

var chart4 = new CanvasJS.Chart("chartContainer4", {
	theme: "light2",
	animationEnabled: true,
	subtitles: [{
		text: "Attrition By Education Field"
	}],
	data: [{
		type: "doughnut",
		indexLabel: "{symbol}  {y}",
		yValueFormatString: "#,##0",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart4.render();
 
}
</script>

<div class="row" style="margin-top: 50px;">
<div class="column">
<div id="chartContainer1" style="height: 270px; width: 100%;"></div>
  </div>
  <div class="column">
  <div id="chartContainer2" style="height: 270px; width: 100%;"></div>
  </div>
</div>
<hr><hr>
  <div class="row" style="margin-top: 10px;">
  <div class="column">
  <div id="chartContainer3" style="height: 270px; width: 100%;"></div>
  </div>
  
  <div class="column">
  <div id="chartContainer4" style="height: 270px; width: 100%;"></div>
  </div>
  </div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>