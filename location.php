<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Locations</title>
<link rel="shortcut icon" href="icon.gif">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
    require_once 'utils.php';
    require 'header.php';
	if(!isset($_GET["locationid"])|| empty($_GET['locationid'])){{
    $location_list=mysqli_query($con, "select * from location;");
    //TODO actloc
    
    if($location_list){
	while($location=$location_list->fetch_assoc()){
	    $locationid=$location['locationid'];
?>

<div class="container">
<div class="row">
  <div class="col-sm-6 col-md-3"> 
    <div class="thumbnail">
      
      <div class="caption">
        <div style="height:100px; margin-bottom:5px"><h3><?=$location['locationname']?></h3></div>
        <p><?=$location['latitude']?>, <?=$location['longitude']?></p>
        <p>Good for
		<?php 	
			  if($a = mysqli_query($con, "select * from actloc natural join activity where locationid='$locationid'"))
			  {
				  while ($b = $a->fetch_assoc())
				  { ?>
					  <a href="activity/<?=$b['activityid']?>" ><?=$b['activityname']?></a>
		<?php
		
			 		}
				  
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
		$locationid=$_GET['locationid'];
		$ln=mysqli_query($con,"select * from location where locationid='$locationid'");
		$ln2=$ln->fetch_assoc();
?>

		<div class="container">
        <h3><?=$ln2['locationname']?></h3>
        <p>Position: <?=$ln2['latitude']?>, <?=$ln2['longitude']?></p>
        <p>Good for 
		<?php 	
			  if($a = mysqli_query($con, "select * from actloc natural join activity where locationid='$locationid'"))
			  {
				  while ($b = $a->fetch_assoc())
				  { ?>
					  <a href="/activity/<?=$b['activityid']?>" > <?=$b['activityname']?> </a>
		<?php 		}
				  
				  }


		
		}
	
?>


</div>

</body>
</html>
