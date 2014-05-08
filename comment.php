<?php
    require_once 'utils.php';

    if(!isset($diaryid)){
	die('diaryid is not set!');
    }

    $comments=mysqli_query($con, "select * from comment natural join user where diaryid='$diaryid'");
    if($comments){
	while($c=$comments->fetch_assoc()){
?>
	<div>
	    <div>
	    <?=$c['username']?>
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
</form>

    
