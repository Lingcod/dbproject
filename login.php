<?php
require_once 'utils.php';

$have_error=false;
$error_txt=array();

if( $_SERVER['REQUEST_METHOD']='POST' ){
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';
    
    if(empty($username)){
	$have_error=true;
	array_push($error_txt, "Username cannot be empty");
    }
    if(empty($password)){
	$have_error=true;
	array_push($error_txt, "Password cannot be empty");
    }

    if(!$have_error){
	$result=mysqli_query($con, "select * from `user` where username='$username' and password='$password';");
	if($result){
	    if($result->num_rows==1){
		$row=$result->fetch_array();
		session_start();
		$userid=$row['userid'];
		$lastaccess=$row['lastaccess'];
		
		$_SESSION['username']=$username;
		$_SESSION['userid']=$userid;
		$_SESSION['lastaccess']=$lastaccess;
		header( "Location: news.php");
		
	    }
	  }
	else{
		$message = "No such user account!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		}
    }



}

?>		

<html style="background: url(login_background.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover; background-size: cover">
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<title>Log In - Wildbook</title>
<link rel="shortcut icon" href="icon.gif">
</head>
<body style="background:none">

<div class="container" id="logincontainer" style="width: 400px !important;margin-top: 100px;">
    <div class="jumbotron">
        <form method ="post" action="" role="form">
        <fieldset>
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
        
          <button type="submit" value="Login" class="btn btn-default" name="login">Submit</button>
          </fieldset>
        </form>
    </div>
</div>

</body>


</html>