<?php

require_once 'connect.php';
function checkLogin(){
	session_start();
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
	    return true;
	}
	return false;
    }
?>
