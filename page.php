<!DOCTYPE HTML>
<html>
<head>
  <title>My Page</title>
  <link rel="shortcut icon" href="icon.gif">
  <link href="global.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  
</head>
<?php
    require_once 'utils.php';
    require_once 'header.php';

    if($isguest){
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
?>
<body>

<div class="row">
    <div class="col-lg-2">
    <div class="container-fluid">
    <?php
        include 'profile.php';
        ?>
     </div> 
    </div>
    <div class="container">
    <div class="col-lg-8">
     
    <?php
        include 'diary_list.php';

    ?>
    </div>
    </div>
</div>
</body>
</html>