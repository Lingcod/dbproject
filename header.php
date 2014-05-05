<?php

    require_once 'utils.php';
    $logedin=checkLogin();
 ?>

<div id="menu">
<div >
    <a href="Index.php">Home</a>
    <a href="About.php">About</a> 
</div>

<?php
if($logedin){?>
<div >
    <a href="page/<?=$_SESSION['userid']?>"><?=$_SESSION['username']?></a>
    <a href="editprofile>">Edit Profile</a>
    <a href="logout">Logout</a>
</div>
<?php
}
?>
</div>
