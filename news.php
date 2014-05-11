<?php

    require_once 'utils.php';
    require_once 'header.php';

    if(!$isguest){
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
    }
    else{
	header('Location: index.php');//TODO add pages for guest
    }

    $result = mysqli_query($con,"select * from news natural join user where privacy<=getrelation(userid,$userid) and getrelation(userid,$userid) between 1 and 2 order by posttime desc ");


    if($result){
	while($row=$result->fetch_assoc()){
		if($row['tablename']=='diary') $tablename='diary';
		else if($row['tablename']=='actloc') $tablename='actloc';
	    ?>
<html>
<head>
  <title>Timeline - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>
<div>

        <div  class="container">
        <ul class="list-group">
          <li class="list-group-item"><h4><?= $row['username']?>: <a href="<?=$tablename?>/<?=$row['pk']?>"><?= $row['title']?></a></h4></li>
          <li class="list-group-item"><?= $row['abstract']?></li>
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
