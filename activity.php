<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Activities</title>
<link rel="shortcut icon" href="icon.gif">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="global.css" rel="stylesheet" type="text/css">


</head>

<body>

<?php
    require_once 'utils.php';
    require 'header.php';
	if(!isset($_GET["activityid"])|| empty($_GET['activityid'])){{
    $activity_list=mysqli_query($con, "select * from activity;");
    //TODO actloc
    
    if($activity_list){
	while($activity=$activity_list->fetch_assoc()){
	    $activityid=$activity['activityid'];
?>



<div class="container">
<div class="row">
  <div class="col-sm-6 col-md-3"> 
    <div class="thumbnail">
      
      <div class="caption">
        <div style="height:100px; margin-bottom:5px"><h3><?=$activity['activityname']?></h3></div>
        
        <p>Available at  
		<?php 	
			  if($a = mysqli_query($con, "select * from actloc natural join location where activityid='$activityid'"))
			  {
				  while ($b = $a->fetch_assoc())
				  { ?>
					  <br><a href="location/<?=$b['locationid']?>" > <?=$b['locationname']?></a>
		<?php 		}
				  
				  }
			  
			  
		?> 
        </p>

      </div>
    </div>
  </div>
  
<?php

	}
    

?>  
</div>

<?php

	}}
	}
	else{
		$activityid=$_GET['activityid'];
		$ln=mysqli_query($con,"select * from activity where activityid='$activityid'");
		$ln2=$ln->fetch_assoc();
?>

		<div class="container">
        <h3><?=$ln2['activityname']?></h3>
        
        <p>Available at
		<?php 	
			  if($a = mysqli_query($con, "select * from actloc natural join location where activityid='$activityid'"))
			  {
				  while ($b = $a->fetch_assoc())
				  { ?>
					  <br><a href="/location/<?=$b['locationid']?>" > <?=$b['locationname']?> </a>
		<?php 		}
				  
				  }


		
		}
	
?>


</div>

</body>
</html>
