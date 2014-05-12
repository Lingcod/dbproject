<?php
    require_once 'utils.php';


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

    function getComment($diaryid){
	global $con;
	$comments=mysqli_query($con, "select * from comment natural join user where diaryid='$diaryid'");
	if($comments){
	    while($c=$comments->fetch_assoc()){
    echo ''?>
		<div>
		<h5>&nbsp;&nbsp;&nbsp;&nbsp;<?=$c['username']?>: <?=$c['content']?> <small> published at <?=$c['posttime']?></small></h5>
		</div>
        <br>
    <?php
	    ;}

	}
	else{
	    $error = mysqli_error($con);
	    echo($error);
	}
	getCommentForm($diaryid);
    }

function getCommentForm($diaryid){
    echo ''?> 
<form method="POST" action="">
    <input type="hidden" name="diaryid" value="<?=$diaryid?>" />
    <textarea name="content" style="border:hidden" class="form-control" placeholder="Leave a comment..."></textarea>
    <button type="submit" value="" class="btn btn-default" name="submit">Submit</button>
</form>
<?php
;}
?>
