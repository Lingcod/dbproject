<!DOCTYPE HTML>

<?php
    require_once 'utils.php';
    $diary_result=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    //TODO actloc
    
    if($diary_result){
	while($diary=$diary_result->fetch_assoc()){
	    $diaryid=$diary['diaryid'];
?>
<html>
<head>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>

	    <div class="list-group">
		<div class="list-group-item-heading">
		    <h4><?=$diary['title']?> </h4>
        </div>
		<div class="list-group-item">
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
		<div class="list-group-item">
        <small>
		<?php
		    echo "MAYBE comments should be here"
		    //include 'comment.php';
		?>
		</small>
	    </div>
        </div>
        </div>
<?php

	}
    }

?>

</body>
</html>