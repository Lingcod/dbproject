<?php 
require_once 'utils.php'; 

$isGuest= !checkLogin();
if(!$isGuest){
    header( "Location: news" );
}
?>

<html>
<head>
<link type="text/css" rel="stylesheet" href="index.css">
</head>
<body>
    <div id="title">
        <div id="logo">
        <h1></h1>
        </div>   
    </div>
        
	<div id="welcome">
        <div class="big_button" id="login"><a href="/login">Login</a></div>
         
        <div class="big_button" id="signup"><a href="/signup">Sign up</a></div>
    </div>
    
    <?php 
        require 'login.php';
        require 'signup.php';
    ?>
    </div>
    
    <div id="aboutus">
    <p>About us			Terms of use		Privacy Policy</p>
    </div>
</body>
</html>
