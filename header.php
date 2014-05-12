<?php

    require_once 'utils.php';
    $isguest=!checkLogin();
    $_SESSION['guest']=$isguest;
 ?>

<div id="menu">
<div >
    <a href="/index.php"><span class="glyphicon glyphicon-home"></span>Homepage</a>&nbsp;&nbsp;
    <a href="/location.php"><span class="glyphicon glyphicon-map-marker"></span>Locations</a>&nbsp;&nbsp;
    <a href="/activity.php"><span class="glyphicon glyphicon-fire"></span>Activities</a>&nbsp;&nbsp;
    <a href="/about.php"><span class="glyphicon glyphicon-tag"></span>About</a> &nbsp;&nbsp;
    <a href="/search.php"><span class="glyphicon glyphicon-search"></span>Search</a> 
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
      <a class="navbar-brand" href="/page/<?=$_SESSION['userid']?>"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['username']?>'s Page </a>
      <a class="navbar-brand" href="/actloc.php"> <span class="glyphicon glyphicon-eye-open"></span> Discover </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-info btn-lg" href="/diary_post.php"><span class="glyphicon glyphicon-pencil"></span> New diary</a></li>
        <li><a class="btn btn-success btn-lg" href="/actloc_post.php"><span class="glyphicon glyphicon-plus"></span> New place for activity</a></li>
        
        <li><a href="/message.php"><span class="glyphicon glyphicon-envelope"></span> Message</a></li>
        <li><a href="/editprofile.php"><span class="glyphicon glyphicon-edit"></span> Profile</a></li>
        <li><a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
