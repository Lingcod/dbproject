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
	  $activityname=$_POST['activityname'];
	  $locationname=mysqli_real_escape_string($con, $_POST['locationname']);
	  $longitude=$_POST['longitude'];
	  $latitude=$_POST['latitude'];
	  $privacy=$_POST['privacy'];

	  if($activityid == -1 && !empty($activityname)){
	      $result=$con->query("insert into activity (activityname) values ('$activityname')");
	      if($result){
		  $activityid=$con->insert_id;
	      }
	      else{
		$message = "Add new activity failed";
		die("<script type='text/javascript'>alert('$message');</script>");
	      }
	  }

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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="/global.js">  </script>
</head>
<body onload="initialize()">
<form method="POST" action="" enctype="multipart/form-data">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="input input-group-lg">
        <h3>Tell others what they can do in this amazing place!</h3>
        </div>
      </div>
      <div class="modal-body">
        <select id="act-select" name="activityid" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" onchange="if(this.value == -1) show_tag('act-input',true); else show_tag('act-input',false);";>
<?php 
	    $act_result=$con->query("select * from activity order by activityname asc");
	    if($act_result){
		while($act_row=$act_result->fetch_assoc()){
?>

	    <option value="<?=$act_row['activityid']?>"><?=$act_row['activityname']?></option>
<?php
		}

	    }
?>
        <option value="-1">Add New</option>
        </select>
	<input style="display: none" id="act-input" name="activityname" class="form-control" type="text" placeholder="New Location Name" value="" />
        <br> <br>
        <div class="row">
          <div class="col-md-5">
            <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" placeholder="Location Name..." name="locationname"/>
          </div>
          <div class="col-md-3">
            <input id="latitude" type="text" step="any" class="form-control" placeholder="Latitude" name="latitude"/>
          </div>
          <div class="col-md-3">
            <input id="longitude" type="text" step="any" class="form-control" placeholder="Longitude" name="longitude"/>
          </div>
        </div>
        <br> <br>


      <div class="modal-footer"> 
        <select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <option value="0">Notify everyone about this news</option>
          <option value="1">Only friends and friends of theirs</option>
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
