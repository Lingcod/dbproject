<?php
require_once 'utils.php';
require_once 'header.php';
if(!checkLogin()){
    header("Location: index.php");
}

$userid=$_SESSION['userid'];


if($_SESSION['REQUEST_METHOD']=='POST'){
    $realname=$_POST['realname'];
    $age=$_POST['age'];
    $city=$_POST['city'];
    $privacy=$_POST['privacy'];

    $result=mysqli_query($con, "update profile set realname='$realname' , age=$age, city='$city' privacy=$privacy where userid=$userid;");
    if($result){
	//TODO: update succeed!
    }
}
else{
    $result=mysqli_query($con, "select * from profile where userid='$userid';");
    if($result && $result->num_rows==1){
	$row=$result->fetch_assoc();
	$realname=$row['realname'];
	$age=$row['age'];
	$city=$row['city'];
	$privacy=$row['privacy'];
    }
}

?>

<form method="post" action="">
    <label for="realname">Real Name</label>   
    <input type="text" name="realname" value="<?=$realname?>" />
    <label for="age">Age</label>   
    <input type="text" name="age" value="<?=$age?>" />
    <label for="city">City</label>   
    <input type="text" name="city" value="<?=$city?>" />
    <label for="privacy">Who can see this?</label>   
    <select name="privacy" >
	<option value="0">Public</option>
	<option value="1">FOF</option>
	<option value="2">Only Friend</option>
	<option value="3">Only Me</option>
    </select>
    <input type="submit" value="Save" />
</form>
