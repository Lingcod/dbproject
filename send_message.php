<!doctype html>
<html>
<head>
<title>Send Message</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="shortcut icon" href="icon.gif">
<?php
    require_once 'utils.php';
    require_once 'header.php';

    if($isguest){
		header('Location: /index.php');
    }

		$receiverid=$_GET['receiverid'];
		$result=mysqli_query($con,"select * from user where userid='$receiverid'");
		$receiver=$result->fetch_assoc();

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$senderid=$_SESSION['userid'];
		$title=mysqli_real_escape_string($con, $_POST['title']);
		$content=mysqli_real_escape_string($con, $_POST['content']);
		if(!$title&&!$content){
			$message = "You can't sent empty message!";
			echo("<script type='text/javascript'>alert('$message');</script>");		
		}
		
		$result=mysqli_query($con,"insert into message(senderid,receiverid,title,content) values ($senderid,$receiverid,'$title','$content')");
		if($result){
			header('Location: /message.php');
		}
		else{
			$message = "Error! Please check you Internet.";
			echo("<script type='text/javascript'>alert('$message');</script>");
		}

	}


?>
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4>Send message to <?=$receiver['username']?></h4>
        <div class="input input-group-lg">
        <input type="text"  style="border:none" class="form-control" name="title" placeholder="Subject..."/>
        </div>
      </div>
      <div class="modal-body">
        <textarea name="content" style="border:none; height:180px" class="form-control" placeholder="Content here..."></textarea>
      <div class="modal-footer">
        <button type="submit" value="Post" class="btn btn-primary">Send</button>
      </div>
    </div><!-- /.modal-content -->
</div>
</form>




</body>
</html>