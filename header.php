<?php

    require_once 'utils.php';
    $isguest=!checkLogin();
    $_SESSION['guest']=$isguest;
 ?>

<div id="menu">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<div >
    <a href="/index.php">Homepage</a>
    <a href="/location.php">Locations</a>
    <a href="/activity.php">Activities</a>
    <a href="/about.php">About</a> 
    <a href="/search.php">Search</a> 
</div>

<?php
if(!$isguest){?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/page/<?=$_SESSION['userid']?>"><?=$_SESSION['username']?>'s Page </a>
      <a class="navbar-brand" href="/actloc.php"> Discover </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-info btn-lg" href="/diary_post.php">Write new diary</a></li>
        <li><a href="/editprofile.php">Edit Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
        <!--form class="navbar-form" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        </form-->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<?php
}
?>
</div>
