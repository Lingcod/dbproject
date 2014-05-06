
<?php
    require_once 'utils.php';
    $diary=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    //TODO actloc
    
    if($diary){
	while($row=$diary->fetch_assoc()){
	    $pics=mysqli_query($con, "SELECT * FROM `picture` WHERE diaryid='{$row['diaryid']}'");
?>
	    <div>
		<div>
		    <?=$row['title']?>
		</div>
		<div>
		    <?=$row['content']?>
		</div>
		<div>
		    <?php
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
		    echo "comments should be here"
		?>
		</div>
	    </div>
<?php

	}
    }

?>
