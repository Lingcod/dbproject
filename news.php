<?php

    require_once 'utils.php';
    require 'header.php';

    if(checkLogin()){
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
    }
    else{
	header('Location: index.php');//TODO add pages for guest
    }

    print("<div>");
    require 'diary_post.php';
    print("</div>");

    $result = mysqli_query($con,"select * from news natural join user where privacy<=getrelation(userid,$userid) and getrelation(userid,$userid) between 1 and 2 order by posttime desc limit 10");



    print("<div>");
    if($result){
	while($row=$result->fetch_assoc()){
	    ?>
	    <div >
		<div><?= $row['username']?>: <?= $row['title']?> </div>
		<div> <?= $row['abstract']?> </div>
	    </div>
	    <?php 
	}

    }
    else{
	print("Something went wrong when fetching from database  :( ");
    }
    print("</div>");
?>
