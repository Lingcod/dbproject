<?php 
require_once 'utils.php';
$username='';

$action = array();
$action['result'] = null;

$have_error=false;
$error_txt=array("username"=>'',"password"=>"","exists"=>"");

if($_SERVER['REQUEST_METHOD']=='POST') {
	//$username = mysqli_real_escape_string($_POST['username']);//TODO
	//$password = mysqli_real_escape_string($_POST['password']);
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';


	if(empty($username)){ $have_error=true; $error_txt["username"]='Uesrname cannot be empty'; }
	if(empty($password)){ $have_error=true; $error_txt["password"]='Password cannot be empty'; }


	//check if the username is available
	if( !$have_error){
	    $result=mysqli_query($con, " select * from `user` where username='$username';");
	    if( $result->num_rows >0 ){
		$have_error=true;
		$error_txt["username"]='User already exists';
	    }
	}


	if( !$have_error){
	    $insert=mysqli_query($con,"insert into `user`(username, password) values('$username','$password');");
	    if($insert){
		$userid = $con->insert_id;
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['userid'] = $userid;
		header( 'Location: news' );

	    }
	}

}
?>

    <script >
    function verify(){
    }
    </script>


<html style="background: url(login_background.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover; background-size: cover">
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<title>Sign Up - Wildbook</title>
<link rel="shortcut icon" href="icon.gif">
</head>
<body style="background:none">

<div class="container" id="logincontainer" style="width: 500px !important;margin-top: 100px;">
    <div class="jumbotron">
        <form method ="post" action="" role="form">
        <fieldset>
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $username?>">
            <td class="error">
            	<?= $error_txt['username'];$error_txt['exists']; ?>
         	</td>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
            <td class="error">
            	<?= $error_txt['username'];$error_txt['exists']; ?>
            </td>
          </div>
          
          <div class="form-group">
            <label for="password">Re-enter Password</label>
            <input type="password" class="form-control" id="verify" placeholder="Password" value="">
            <td class="error">
            	<?=$error_txt['password']?>
            </td>
          </div>
        
          <button type="submit" value="Login" class="btn btn-default" name="login">Submit</button>
          </fieldset>
        </form>
    </div>
</div>

</body>
</html>
