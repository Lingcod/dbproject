<?php
    require_once 'utils.php';
    require_once 'header.php';

    if(!checkLogin()){
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
	    header("Location: diary/$diaryid");
	}


    }

?>


<form method="POST" action="">
	    <label for="title">Title:</label>
	    <input type="text" name="title" />
	    <textarea name="content" placeholder="Content here"></textarea>
	    <select name="privacy" >
		<option value="0">Public</option>
		<option value="1">FOF</option>
		<option value="2">Only Friend</option>
		<option value="3">Only me</option>
	    </select>
	    <!--TODO: add location -->
	    <input type="submit" value="Post" class="large blue button"/>			
</form>			
