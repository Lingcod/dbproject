
<?php
    require_once 'utils.php';
    $diary_result=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    //TODO actloc
    
    if($diary_result){
	while($diary=$diary_result->fetch_assoc()){
	    $diaryid=$diary['diaryid'];
?>
	    <div>
		<div>
		    <?=$diary['title']?> </div>
		<div>
		    <?=$diary['content']?>
		</div>
		<div>
		    <?php
			$pics=mysqli_query($con, "SELECT * FROM `picture` WHERE diaryid='{$diaryid}'");
			if($pics){
			    while($pic=$pics->fetch_assoc()){
			    ?>
			    <img src="/image.php?picid=<?=$pic['picid']?>" />
			    <?php
			    }
			}
		    ?>
		</div>
		<div>
		<?php
		    //echo "comments should be here"
		    include 'comment.php';
		?>
		</div>
	    </div>
<?php

	}
    }

?>
