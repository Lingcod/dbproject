<?php
    require_once 'utils.php';
    require_once 'header.php';
    include 'comment.php';
    require_once 'like.php';


    $userid = (isset($_SESSION['userid']))? intval($_SESSION['userid']) : null;
    $diaryid = (isset($_GET['diaryid']) && is_numeric($_GET['diaryid'])) ? intval($_GET['diaryid']) : 0;

    $diary_result=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and diaryid=$diaryid");
    //TODO actloc
    
    if($diary_result){
	$diary=$diary_result->fetch_assoc();
?>
<html>
<head>
  <title>Diary - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="/jquery.min.js"></script>
<script src="/global.js"></script>
<div  class="container">
	<div>
		<h1> <?=$diary['title']?> <small>published at <?=$diary['posttime']?></small></h1>
        <br><br>
		<h5> <?=$diary['content']?></h5>
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
	    <?php like_btn($userid, $diaryid, 'diary')?>
		</div>
		<div>
        <br>
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



