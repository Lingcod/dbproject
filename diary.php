<?php
    require_once 'utils.php';
    require_once 'header.php';
    include 'comment.php';


    $userid = $_SESSION['userid'];
    $diaryid = (isset($_GET['diaryid']) && is_numeric($_GET['diaryid'])) ? intval($_GET['diaryid']) : 0;

    $diary_result=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and diaryid=$diaryid");
    //TODO actloc
    
    if($diary_result){
	$diary=$diary_result->fetch_assoc();
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
		    //echo "MAYBE comments should be here"
		    getComment($diaryid);
		?>
		</div>
	    </div>

	    <?php

    }
    else{
	echo $con->error;
    }
?>



