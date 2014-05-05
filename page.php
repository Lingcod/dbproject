<?php
    require_once 'utils.php';
    require_once 'header.php';

    if(!checkLogin()){
	header("Location: index.php");
	//TODO  page for guests
    }

    $userid=$_SESSION['userid'];

    if(!isset($_GET['pageid']) || empty($_GET['pageid'])){
	header("HTTP/1.0 404 Not Found");
       echo "<h1>404 Not Found</h1>";
       echo "The page that you have requested could not be found.";
       die();
    }
    $pageid=$_GET['pageid'];


    include 'profile.php';
    include 'diary_list.php';


?>
