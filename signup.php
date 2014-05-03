<?php 
require_once 'connect.php';//TODO

$action = array();
$action['result'] = null;

$have_error=false;
$error_txt=array("username"=>'',"password"=>"","exists"=>"");

if($_SERVER['REQUEST_METHOD']=='POST') {
	//$username = mysqli_real_escape_string($_POST['username']);//TODO
	//$password = mysqli_real_escape_string($_POST['password']);
	$username = $_POST['username'];
	$password = $_POST['password'];


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
		header( 'Location: '.$userid );

	    }
	}

}
?>

<form method="post" action="">
    <fieldset>
      <table>
        <tr>
          <td class="label">
            Username
          </td>
          <td>
      <input type="text" name="username" value="<?=$username?>">
          </td>
          <td class="error">
            <?= $error_txt['username'];$error_txt['exists']; ?>
          </td>
        </tr>

        <tr>
          <td class="label">
            Password
          </td>
          <td>
            <input type="password" id="password" name="password" value="">
          </td>
          <td class="error">
            <?=$error_txt['password']?>
          </td>
        </tr>
        <tr>
          <td class="label">
            Password Again
          </td>
          <td>
            <input type="password" id="verify" value="">
          </td>
        </tr>
      </table>
      <input type="submit">
    </fieldset>


</form>			
    <script >
    function verify(){
    }
    </script>


