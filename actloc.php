<?php
    require_once 'utils.php';
    require_once 'header.php';


    if($con->query("select * from actloc natural join user natural join locationid natural join activity")){
	while($row=$con->fetch_assoc()){
?>
	<div>
    <?php echo "{$row['username']} : {$row['locationname']} is a good place for {$row['activityname']}"; ?>
	</div>
<?php
	}
    }
    

?>
