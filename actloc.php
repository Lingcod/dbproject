<!DOCTYPE html>
<html>
<head>
<title>Discover - Wildbook</title>
<link rel="shortcut icon" href="icon.gif">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="/jquery.min.js"></script>
<script src="/global.js"></script>
<?php
    require_once 'utils.php';
    require_once 'header.php';
    require_once 'like.php';

    if(!$isguest){
	$userid=$_SESSION['userid'];
    }
    else
	$userid=null;
?>
<div class="container">	
<div class="row">
<?php
  if(!isset($_GET["actlocid"])|| empty($_GET['actlocid'])){
    if($a = mysqli_query($con,"select * from actloc natural join user natural join location natural join activity natural join likeactloc_num order by like_num DESC")){
		while($row=$a->fetch_assoc()){
?>
          
            <div class="col-sm-4 col-md-3">
              <div class="thumbnail">
                <div class="caption" style="height:250px">
                  <h3><?=$row['username']?>:</h3>
                  <div style="height:100px"><p><b><?=$row['locationname']?></b> is a good place for <b><?=$row['activityname']?></b></p></div>
                  <p><a href="activity/<?=$row['activityid']?>">Other Places for <?=$row['activityname']?></a></p>
                  <p><a href="location/<?=$row['locationid']?>">Other Activities at <?=$row['locationname']?></a></p>
                </div>
	    <?php like_btn($userid,$row['actlocid'],'actloc'); ?>
              </div>
            </div>
          
		
<?php
		}
    }
    }
?>
</div>
</div>
</body>
</html>
