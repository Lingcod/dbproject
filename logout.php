<?php
    session_start();
    require_once 'utils.php';
    $userid=$_SESSION['userid'];
    $con->query("update user set lastaccess=NOW() where userid=$userid");
    session_destroy();
    header('Location: index');
?>

