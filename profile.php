<!DOCTYPE HTML>
<?php
    require_once 'utils.php';
    $result=mysqli_query($con, "select * from profile  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    
    if($result){
	//TODO: maybe it should be clear whether it's hidden or it has not been set yet.
	while($row=$result->fetch_assoc()){
?>

<html>
<head>
  <link rel="shortcut icon" href="icon.gif">
  <link href="global.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
  <div class="jumbotron">
	   
		<div>
		    Name: <?=$row['realname']?>
		</div>
		<div>
		    Age: <?=$row['age']?>
		</div>
		<div>
		    <?=$row['city']?>
		</div>
	   
   </div>

<?php
	}
    }

?>
</body>
</html>