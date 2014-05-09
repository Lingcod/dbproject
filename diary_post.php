<?php
    require_once 'utils.php';
    require_once 'header.php';

    if($isguest){
	header('Location: index.php');
    }


    if($_SERVER['REQUEST_METHOD']=='POST'){
	$userid=$_SESSION['userid'];
	$title=$_POST['title'];
	$content=$_POST['content'];
	$privacy=$_POST['privacy'];

	if(isset($_POST['locationid'])){
	    if($_POST['locationid']=='new'){
		$locationid=newLocation($_POST['locationname']);
		//TODO  if insert location fail?
	    }
	    else{
		$locationid = $_POST['locationid'];
	    }
	}
	else{
	    $locationid = 'NULL';
	}
	$result=mysqli_query($con, "insert into diary(title, content, privacy, userid, locationid) values('$title','$content', $privacy, $userid, $locationid)");
	if($result){
	    $diaryid=$con->insert_id;
	    $abstract=implode(' ', array_slice(explode(' ', $content), 0, 100));
	    mysqli_query($con, "insert into news (tablename, pk, userid, privacy, title, abstract ) values ('diary', $diaryid, $userid, $privacy, '$title','$abstract')") ;
	    if(isset($_FILES['pic'])){
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



    }

?>


<!--form method="POST" action="" enctype="multipart/form-data">
	    <label for="title">Title:</label>
	    <input type="text" name="title" />
	    <textarea name="content" placeholder="Content here"></textarea>
	    <select name="privacy" >
		<option value="0">Public</option>
		<option value="1">FOF</option>
		<option value="2">Only Friend</option>
		<option value="3">Only me</option>
	    </select>
	    <input type="file" name="pic[]" multiple />
	    <input type="submit" value="Post" class="large blue button"/>			
</form-->			


<html>
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="shortcut icon" href="icon.gif">
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="input input-group-lg">
        <input type="text"  style="border:none" class="form-control" name="title" placeholder="Title..."/>
        </div>
      </div>
      <div class="modal-body">
        <textarea name="content" style="border:none; height:40%" class="form-control" placeholder="Content here..."></textarea>
        <p></p>
     		<select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <option value="0">Everyone could read this diary</option>
            <option value="1">Only friends and friends of them</option>
            <option value="2">Only Friend</option>
            <option value="3">Only me</option>
            </select>
           <p></p>
      <input type="file" name="pic[]" multiple />
      </div>
      <div class="modal-footer">
            
           
        <button type="submit" value="Post" class="btn btn-primary">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

</form>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
