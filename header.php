<?php

    require_once 'utils.php';
    $logedin=checkLogin();
 ?>

<div id="menu">
<div >
    <a href="index.php">Homepage</a>
    <a href="about.php">About</a> 
</div>

<?php
if($logedin){?>
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
      <a class="navbar-brand" href="/page/<?=$_SESSION['userid']?>"><?=$_SESSION['username']?>'s Page</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-info btn-lg" href="diary_post.php">Write new diary</a></li>
        <li><a href="editprofile.php">Edit Profile</a></li>
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
