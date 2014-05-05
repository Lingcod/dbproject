
<?php
    require_once 'utils.php';
    $diary=mysqli_query($con, "select * from diary  where  privacy<=getrelation(userid, $userid) and userid='$pageid';");
    //TODO actloc
    
    if($diary){
	while($row=$diary->fetch_assoc()){
?>
	    <div>
		<div>
		    <?=$row['title']?>
		</div>
		<div>
		    <?=$row['content']?>
		</div>
		<div>
		<?php
		    echo "comments should be here"
		?>
		</div>
	    </div>
<?php

	}
    }

?>
