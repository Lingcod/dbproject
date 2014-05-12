<html>
<head>
  <title>Timeline - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="/jquery.min.js"></script>
<script src="/global.js"></script>

<?php
require_once 'utils.php';
require_once 'header.php';
if(!checkLogin()){
    header("Location: index.php");
}
$userid=$_SESSION['userid'];

if($_SERVER['REQUEST_METHOD']=='POST' ){
    $realname=$_POST['realname'];
    $age=$_POST['age'];
    if(empty($age)) $age='null';
    $city=$_POST['city'];
    $privacy=$_POST['privacy'];

    $result=mysqli_query($con, "update `profile` set realname='$realname' , age=$age, city='$city', privacy=$privacy where userid=$userid");
    if(!$result){
	//TODO: update succeed!
	echo '<div style="color: red">save failed!</div>';
    }
}

{
    $result=mysqli_query($con, "select * from profile where userid='$userid'");
    if($result && $result->num_rows==1){
	$row=$result->fetch_assoc();
	$realname=$row['realname'];
	$age=$row['age'];
	$city=$row['city'];
	$privacy=$row['privacy'];
    }
}

?>



<div class="narrow-body-wb">

<form class="editprofile" method="post" action="" role="form">
	<div class="form-group">
    <label for="realname">Real Name</label>   
    <input type="text" name="realname" class="form-control" value="<?=$realname?>" />
    </div>
    <div class="form-group">
    <label for="age">Age</label>   
    <input type="text" name="age" class="form-control" value="<?=$age?>" />
    </div>
    <div class="form-group">
    <label for="city">City</label>   
    <input type="text" name="city" class="form-control" value="<?=$city?>" />
    </div>
    <div class="form-group">
    <label for="privacy">Who can view your profile?</label> <br>  
    <select name="privacy" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	<option value="0">Everyone</option>
	<option value="1">Only Friends and friends of them</option>
	<option value="2">Only Friend</option>
	<option value="3">Only Me</option>
    </select>
    </div>
    <br><br>
    <div class="form-group">
    <button type="submit" value="Save" name="editprofile" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
	</div>
</form>

<?php
    include_once 'likeactivity.php';
?>
</div>

</body>
</html>
