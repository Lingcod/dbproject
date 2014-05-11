<?php
    require_once 'utils.php';
    require_once 'header.php';

    if($isguest){
	header('Location: /index.php');
    }


    if($_SERVER['REQUEST_METHOD']=='POST'){
	  if(empty($_POST['locationname'])){
		  exit("Location Name!");
	  }
	  
	  $userid=$_SESSION['userid'];
	  $username=$_SESSION['username'];
	  $activityid=$_POST['activityid'];
	  $locationname=mysqli_real_escape_string($con, $_POST['locationname']);
	  $longitude=$_POST['longitude'];
	  $latitude=$_POST['latitude'];
	  $privacy=$_POST['privacy'];

	  $result = mysqli_query($con,"select activityname from activity where activityid='$activityid'");
	  $row = $result->fetch_assoc();
	  $acitivityname = $row['activityname'];

	  $isnew = mysqli_query($con,"select locationid from location where locationname='$locationname'");
	  $row = $isnew->fetch_assoc();
	  
	  if(empty($row)){
		$result = mysqli_query($con,"insert into location(locationname, longitude, latitude) values ('$locationname', $longitude, $latitude)");
		$locationid = $con->insert_id;
			//TODO  if insert location fail?
	  }
	  else{
		
		$locationid = $row['locationid'];
		$isnewactloc = mysqli_query($con,"select * from actloc where activityid='$activityid' and locationid='$locationid'");
		$row = $isnewactloc->fetch_assoc();
		if (!empty($row)) {
			$message = "This place for activity is already exist!";
			die("<script type='text/javascript'>alert('$message');</script>");
		}
	  }
		
		$result=mysqli_query($con, "insert into actloc(activityid,locationid,userid) values ($activityid,$locationid,$userid)");
		if($result){
			$actlocid=$con->insert_id;
			$title= $username . " thought " . $locationname . " is a good place for" . $activityname;
			mysqli_query($con, "insert into news (tablename, pk, userid, privacy, title) values ('actloc', $actlocid, $userid, $privacy,'$title')");
  
			header("Location: actloc.php");
	
		}



    }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Post New Place for Activity</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="shortcut icon" href="icon.gif">
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="input input-group-lg">
        <h3>Tell others what they can do in this amazing place!</h3>
        </div>
      </div>
      <div class="modal-body">
        <select name="activityid" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <option value="1">Fishing</option>
          <option value="2">Hiking</option>
          <option value="3">Swimming</option>
          <option value="4">Skydiving</option>
        </select>
        <br> <br>
        <div class="row">
          <div class="col-md-5">
            <input type="text" class="form-control" placeholder="Location Name..." name="locationname"/>
          </div>
          <div class="col-md-3">
            <input type="number" step="any" class="form-control" placeholder="Latitude" name="latitude"/>
          </div>
          <div class="col-md-3">
            <input type="number" step="any" class="form-control" placeholder="Longitude" name="longitude"/>
          </div>
        </div>
        <br> <br>


      <div class="modal-footer"> 
        <select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <option value="0">Everyone could read this diary</option>
          <option value="1">Only friends and friends of them</option>
          <option value="2">Only Friend</option>
          <option value="3">Only me</option>
        </select> 
        <button type="submit" value="Post" class="btn btn-primary">Submit</button>
      </div>
    </div><!-- /.modal-content -->
</div>
</form>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
