<!DOCTYPE HTML>
<html>
<head>
<title>Message - Wildbook</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="shortcut icon" href="icon.gif">
<?php
    require_once 'utils.php';
    require_once 'header.php';
    if($isguest){
		header('Location: /index.php');
    }
	
	$userid = $_SESSION['userid'];
	$send_message_list=mysqli_query($con,"select * from message where senderid='$userid' order by posttime desc");
	$receive_message_list=mysqli_query($con,"select * from message where receiverid='$userid' order by posttime desc");
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$privacy=$_POST['privacy'];
		$requesterid=$_POST['requesterid'];
		$result1=mysqli_query($con,"insert into friendship(maker,makee,privacy) values ($userid,$requesterid,$privacy)");
		$result2=mysqli_query($con,"insert into friendship(maker,makee,privacy) values ($requesterid,$userid,$privacy)");
		$result3=mysqli_query($con,"delete from message where senderid=$requesterid and receiverid=$userid and title='Friend Request'");
			 
		if($result1&&$result2&&$result3){
			header('location: /message');
		}
		else{
			$message = "Please try again!";
			echo("<script type='text/javascript'>alert('$message');</script>");
		}
		
		
		
	}
	

?>
</head>
<body>
<div class="container"> 
<div class="row">



<?php
	if($receive_message_list){
?>

    <div class="col-sm-6 col-md-6 col-lg-6">
    <h3>Inbox</h3>
<?php
	while($receive_message=$receive_message_list->fetch_assoc()){
	    $sender=$receive_message['senderid'];
		$result=mysqli_query($con,"select * from user where userid='$sender'");
		$row=$result->fetch_assoc();
		$sendername=$row['username'];
		$content=$receive_message['content'];
		if($receive_message['title']=='Friend Request'){
			$content=
			'<select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<option value="0">Public Relationship to Everyone</option>
				<option value="1">Only friends and friends of theirs</option>
				<option value="2">Only Friend</option>
				<option value="3">Only me</option>
			 </select>
			 
			 <button type="submit" value="Post" class="btn btn-primary">Confirm Friend Request</button>';
			
			
		}//if $receive_message['title']=='Friend Request'
?>
<form method="POST" action="" enctype="multipart/form-data">
	    <div class="list-group">
            <div class="list-group-item">
                <h4><?=$receive_message['title']?> <small>from <a href="/page/<?=$sender?>"><?=$sendername?></a>, <?=$receive_message['posttime']?></small></h4>
                <div>
                    <?=$content?>
                </div>
                <input type="hidden" name="requesterid" value="<?=$sender?>" />
            </div>
        </div>
</form>
<?php

	}//while($receive_message=$receive_message_list->fetch_assoc())
?>

    </div>
    
<?php
    }//if($receive_message_list)
?>

<?php
	if($send_message_list){
?>
	
   
    <div class="col-sm-6 col-md-6 col-lg-6">
    <h3>Outbox</h3>
<?php
	while($send_message=$send_message_list->fetch_assoc()){
	    $receiver=$send_message['receiverid'];
		$result=mysqli_query($con,"select * from user where userid='$receiver'");
		$row=$result->fetch_assoc();
		$receivername=$row['username'];
?>

	    <div class="list-group">
            <div class="list-group-item">
                <h4><?=$send_message['title']?> <small>to <a href="/page/<?=$receiver?>"><?=$receivername?></a>, <?=$send_message['posttime']?></small></h4>
                <div>
                    <?=$send_message['content']?>
                </div>
            </div>
        </div>
<?php

	}
?>

    </div>

<?php
    }
?>

</div>
</div>
</body>
</html>