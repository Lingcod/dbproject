<?php

require_once 'connect.php';
function checkLogin(){
	if(!isset($_SESSION)){
	    session_start();
	}
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
	    return true;
	}
	return false;
}


function get_act_str($userid){
    global $con;
    $result=$con->query("select * from likeactivity natural join activity where userid=$userid order by addtime asc");
    if($result){
	$data=array();
	while($row=$result->fetch_assoc()){
	    array_push($data, $row['activityname']);
	}
	return implode(',',$data);
    }
    else
	return '';
}
?>
