<?php 
require 'utils.php'; 

$isGuest= !checkLogin();
if(!$isGuest){
    header( "Location: ".$_SESSION['userid'] );
}
?>

<html>
<head>
</head>
<body>
    <h1>Wilebook</h1>
    <div>Welcome Guest!
    <a href="login">Login</a> or <a href="signup">Sign up</a>

<?php 
    require 'login.php';
    require 'signup.php';
?>
</div>
</body>
</html>
