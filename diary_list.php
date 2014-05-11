<script src="/jquery.min.js"></script>
<script src="/global.js"></script>
<?php
    require_once 'utils.php';
    require_once 'comment.php';
    require_once 'like.php';
    $userid = $_SESSION['userid'];
    $diary_result=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and userid='$pageid' order by posttime DESC;");
    //TODO actloc
    
    if($diary_result){
	while($diary=$diary_result->fetch_assoc()){
	    $diaryid=$diary['diaryid'];
?>

	    <div class="list-group">
		<div class="list-group-item-heading">
		    <h4> <a href="/diary/<?=$diary['diaryid']?>"><?=$diary['title']?></a></h4>
        </div>
		<div class="list-group-item">
        <div>
		    <?=$diary['content']?>
		</div>
		<div>
		    <?php
			$pics=mysqli_query($con, "SELECT * FROM `picture` WHERE diaryid='{$diaryid}'");
			if(!empty($pics)){
			    while($pic=$pics->fetch_assoc()){
			    ?>
			    <img src="/image.php?picid=<?=$pic['picid']?>" />
			    <?php
			    }
			}
		    ?>
		</div>
		<div>
	    <?php like_btn($userid, $diaryid,'diary') ?>
		</div>
		<div>
        <small>
		<?php
		    //echo "MAYBE comments should be here"
		    getComment($diaryid);

		?>
		</small>
	    </div>
        </div>
        </div>
<?php

	}
    }
    else{
	echo "fail to fetch diary_list userid:$userid, pageid:$pageid";
    }

?>

