<?php
require_once 'utils.php';

header('Content-Type: image/jpeg');
$picid = (isset($_GET['picid']) && is_numeric($_GET['picid'])) ? intval($_GET['picid']) : 0;

    $result=mysqli_query($con, "SELECT * FROM `picture` WHERE picid='$picid'");
    if($result){
	while($row=$result->fetch_assoc()){
	    echo $row['pic'];
	}
    }


?>
