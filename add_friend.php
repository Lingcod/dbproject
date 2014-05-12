<html>
<head>
<title>Wildbook</title>
<link rel="shortcut icon" href="icon.gif">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="global.css" rel="stylesheet" type="text/css">
</head>
<?php
    require_once 'utils.php';
	require_once 'header.php';

    if($isguest){
		header('Location: /index.php');
    }

		$receiverid=$_GET['receiverid'];
		$result=mysqli_query($con,"select * from user where userid='$receiverid'");
		$receiver=$result->fetch_assoc();
		$senderid=$_SESSION['userid'];
		$title='Friend Request';
		
		$result=mysqli_query($con,"insert into message(senderid,receiverid,title) values ($senderid,$receiverid,'$title')");
		if($result){
			$message = "Success!";
			echo("<script type='text/javascript'>alert('$message');</script>");
		}
		else{
			$message = "Error! Please check you Internet.";
			echo("<script type='text/javascript'>alert('$message');</script>");
		}




?>
<body>
<br><br><br><br><br>
<h2 align="center"><a href="/page/<?=$receiverid?>">Back to his/her page...</a></h2>
</body>
</html>