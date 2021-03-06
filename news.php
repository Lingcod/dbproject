<?php

    require_once 'utils.php';
    require 'header.php';
    require_once 'comment.php';
    require_once 'like.php';

    if(!$isguest){
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$lastaccess=$_SESSION['lastaccess'];
    }
    else{
	header('Location: index.php');//TODO add pages for guest
    }

?>

<html>
<head>
  <title>Timeline - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="/jquery.min.js"></script>
<script src="/global.js"></script>
<div>
<?php
    $divided=false;
    $result = mysqli_query($con,"select * from news natural join user where privacy<=getrelation(userid,$userid) and getrelation(userid,$userid) between 1 and 2 order by posttime desc ");

    if($result){
	if($result->num_rows==0){
	    $result = $con->query("select * from news natural join user where privacy=0");
	    echo '<div  class="container"><div style="color: #5bc0de; text-align: center; font-weight: bold" >You do not have any news. So we recommend these to you.</div></div><br>';
	}

	while($row=$result->fetch_assoc()){
		if($row['tablename']=='diary') $tablename='diary';
		else if($row['tablename']=='actloc') $tablename='actloc';

		if($row['posttime']<=$lastaccess && $divided==false ){
		    echo '<div  class="container"><div style="color: #5bc0de; text-align: center; font-weight: bold" >Above is what happended after last time you came</div></div><br>';

		    $divided=true;
		}
	    ?>


	    
<div  class="container">
        <ul class="list-group">
	    <li class="list-group-item">
		<h4><a href="page/<?=$row['userid']?>"><?= $row['username']?></a>: 
		<a href="<?=$tablename?>/<?=$row['pk']?>"<?php if($tablename=="actloc") echo 'onclick="return false;"' ?>>
		    <?= $row['title']?>
		</a>
		</h4>
        <?= $row['abstract']?><br>
        <?php like_btn($userid,$row['pk'],$tablename)?><br>
        <?php if($row['tablename']=='diary'){ getComment($row['pk']); } ?></li>
        </ul>
        </div>


	    <?php 
	}

    }
    else{
	print("Something went wrong when fetching from database  :( ");
    }
?>
</div>

</body>

</html>
