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

function isNewLocation($lname){
    if($con->query("select * from location where locationname='$lname'")){
	$row = $con->fetch_assoc();
	return $row['locationid'];
    }
    else{
	return null;
    }
}

function isNewAct($aname){
    if($con->query("select * from activity where activityname='$aname'")){
	$row = $con->fetch_assoc();
	return $row['activityid'];
    }
    else{
	return null;
    }
}

function addLocation($lname, $longitude, $latitude){
    return $con->query("insert into location(locationname, longitude, latitude) values ('$lname', $longitude, $latitude)");
}

function addAct($aname){
    return $con->query("insert into activity(activityname) values ('$aname')");
}

?>
