<?php
    require_once 'utils.php';
    $result=mysqli_query($con, "select * from profile  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    
    if($result){
	//TODO: maybe it should be clear whether it's hidden or it has not been set yet.
	while($row=$result->fetch_assoc()){
?>
	    <div>
		<div>
		    <?=$row['realname']?>
		</div>
		<div>
		    <?=$row['age']?>
		</div>
		<div>
		    <?=$row['city']?>
		</div>
	    </div>
<?php
	}
    }

?>
