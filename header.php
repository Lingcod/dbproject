<?php

    require_once 'utils.php';
    $logedin=checkLogin();
 ?>

<div id="menu">
<span >
    <a href="Index.php">Home</a>
    <a href="About.php">About</a> 
</span>

<?php
if($logedin){?>
<span >
    <a href="profile/<?=$_SESSION['userid']?>"><?=$_SESSION['username']?></a>
    <a href="logout">Logout</a>
</span>
<?php
}
?>
</div>
