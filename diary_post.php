<?php
    require_once 'utils.php';
    require_once 'header.php';

    if($isguest){
	header('Location: /index.php');
    }


    if($_SERVER['REQUEST_METHOD']=='POST'){
	$userid=$_SESSION['userid'];
	$title=mysqli_real_escape_string($con, $_POST['title']);
	$content=mysqli_real_escape_string($con, $_POST['content']);
	$privacy=$_POST['privacy'];

	if(!empty($_POST['locationname'])){
		$locationname=$_POST['locationname'];
		
		$isnew = mysqli_query($con,"select locationid from location where locationname='$locationname'");
		
		if($isnew->num_rows==0){
		  $longitude=$_POST['longitude'];
		  $latitude=$_POST['latitude'];
		  $result = mysqli_query($con,"insert into location(locationname, longitude, latitude) values ('$locationname',$longitude,$latitude)");
		  //$row = $result->fetch_assoc();
		  $locationid = $con->insert_id;
		  //TODO  if insert location fail?
	    }
	    else{
		$row = $isnew->fetch_assoc();
		  $locationid = $row['locationid'];
	    }
	}
	else{
	    $locationid = 'NULL';
	}

	$result=mysqli_query($con, "insert into diary(title, content, privacy, userid, locationid) values('$title','$content', $privacy, $userid, $locationid)");
	if($result){
	    $diaryid=$con->insert_id;
	    $abstract=implode(' ', array_slice(explode(' ', $content), 0, 100));
	    mysqli_query($con, "insert into news (tablename, pk, userid, privacy, title, abstract ) values ('diary', $diaryid, $userid, $privacy,'$title','$abstract')");
		
	    if(!empty($_FILES['pic']['tmp_name'][0])){
		  $pics = $_FILES['pic'];
		  foreach($pics['tmp_name'] as $key=>$value){
			echo $value;
			$pic = addslashes(file_get_contents($value));
			$pic_result=mysqli_query($con, "insert into `picture` (`diaryid`,`pic`) values ($diaryid, '{$pic}')");
			  if(!$pic_result){
				$error = mysqli_error($con);
			  }
  
		  }

	    }
	    header("Location: diary/$diaryid");

	}
	else{
	  die(var_dump("insert into diary(title, content, privacy, userid, locationid) values('$title','$content', $privacy, $userid, $locationid)")); 
	  header("HTTP/1.0 404 Not Found");




    }
    }

?>

<html>
<head>
<title>Post New Diary</title>
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
        <input type="text"  style="border:none" class="form-control" name="title" placeholder="Title..."/>
        </div>
      </div>
      <div class="modal-body">
        <textarea name="content" style="border:none; height:35%" class="form-control" placeholder="Content here..."></textarea>
        <br>
     		<select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <option value="0">Everyone could read this diary</option>
            <option value="1">Only friends and friends of them</option>
            <option value="2">Only Friend</option>
            <option value="3">Only me</option>
            </select>
       <br> <br>
      <input type="file" name="pic[]" multiple /> <br>
      <div class="row">
        <div class="col-md-5">
          <input id="autocomplete" type="text" class="form-control" placeholder="Your location..." name="locationname"/>
        </div>
        <div class="col-md-3">
          <input id="latitude" type="text" class="form-control" placeholder="latitude" name="latitude"/>
        </div>
        <div class="col-md-3">
          <input id="longitude" type="text" class="form-control" placeholder="longitude" name="longitude"/>
        </div>
      </div>
      <div class="modal-footer">
            
           
        <button type="submit" value="Post" class="btn btn-primary">Submit</button>
      </div>
    </div><!-- /.modal-content -->
</div>
</form>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
