<?php
require_once 'utils.php';

$have_error=false;
$error_txt=array();

if( $_SERVER['method']='POST' ){
    $username=$_POST['username'];
    $password=$_POST['password'];
    
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
		$_SESSION['username']=$username;
		$_SESSION['userid']=$userid;
		header( "Location: $userid");
		
	    }
	}
    }



}

?>



<form method="post" action="">
    <fieldset>
    	<ul>
    		<li>
    			<label for="username">Username:</label>
    			<input type="text" name="username" />
    		</li>
    		<li>
    			<label for="password">Password:</label>
    			<input type="password" name="password" />
    		</li>
    		<li>
    			<input type="submit" value="Login" class="large blue button" name="login" />			
    		</li>
    	</ul>
    </fieldset>
</form>			

