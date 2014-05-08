<html>

<?php 
require_once 'utils.php'; 

$isGuest= !checkLogin();
if(!$isGuest){
    header( "Location: news.php" );
}
?>


<head>
  <title>Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body style="background:none">
    <div id="title">
        <div id="logo">
        <h1></h1>
        </div>   
    </div>
        
	<div id="welcome">
        <a id="login" class="btn btn-default btn-lg" href="login.php">&nbsp;&nbsp;&nbsp;&nbsp;Log In&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <a id="signup" class="btn btn-default btn-lg" href="signup.php">&nbsp;&nbsp;&nbsp;&nbsp;Sign Up&nbsp;&nbsp;&nbsp;&nbsp;</a>
    </div>
    
    <!--?php 
        require 'login.php';
        require 'signup.php';
    ?-->
    </div>
    
    <div id="aboutus">
    <p>About us			Terms of use		Privacy Policy</p>
    </div>
</body>
</html>
