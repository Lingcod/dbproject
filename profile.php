<?php
    require_once 'utils.php';
	$lastaccess = $_SESSION['lastaccess'];
    $result=mysqli_query($con, "select * from profile  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    
    if($result){
	//TODO: maybe it should be clear whether it's hidden or it has not been set yet.
	while($row=$result->fetch_assoc()){
?>

  <div class="jumbotron">
		<div>
		    <strong>Name: </strong><?=$row['realname']?>
		</div>
		<div>
		    <strong>Age: </strong><?=$row['age']?>
		</div>
		<div>
		    <strong>City: </strong><?=$row['city']?>
		</div>
        <div>
		    <strong>Last Access: </strong><br><?=$lastaccess?>
		</div>
	   
    <div>
<strong>Like:</strong><?php echo get_act_str($pageid); ?>
    </div>
   </div>

<?php
	}
    }

?>
