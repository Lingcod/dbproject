<?php

require_once 'connect.php';
function checkLogin(){
	session_start();
	     
	if(empty($_SESSION[$username])) {
	    return false;
	}
	return true;
    }
?>
