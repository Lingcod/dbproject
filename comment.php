<?php
    require_once 'utils.php';

    if(!isset($diaryid)){
	die('diaryid is not set!');
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
	$new_content=$_POST['content'];
	$new_diaryid=$_POST['diaryid'];
	$userid=$_SESSION['userid'];
	if($con->query("insert into comment(content, userid, diaryid) values ('$new_content',$userid,$new_diaryid)")){
	}
	else{
	    echo( $con->error);
	    
	}
    }

    $comments=mysqli_query($con, "select * from comment natural join user where diaryid='$diaryid'");
    if($comments){
	while($c=$comments->fetch_assoc()){
?>
	<div>
	    <div>
	    <?=$c['username']?>:
	    </div>
	    <div>
	    <?=$c['content']?>
	    </div>
	</div>
<?php
	}

    }
    else{
	$error = mysqli_error($con);
	die($error);
    }
?>

<form method="POST" action="">
    <input type="hidden" name="diaryid" value="<?=$diaryid?>" />
    <textarea name="content" placeholder="Your comment here"></textarea>
    <button type="submit" value="" class="btn btn-default" name="submit">Submit</button>
</form>