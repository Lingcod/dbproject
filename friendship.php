<?php
    require_once 'utils.php';
    require_once 'header.php';
	if($isguest){
		header("Location: index.php");
    }
    $page=$_GET['page'];
	$userid = $_SESSION['userid'];
	$friend_list=mysqli_query($con,"select * from friendship where maker='$page' and privacy<=getrelation($page, $userid)");

?>

<html>
<head>
  <title>Friends - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link href="global.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<div class="row">
<?php
    if($friend_list){
		while($row=$friend_list->fetch_assoc()){
			$addtime=$row['addtime'];
			$other_userid=$row['makee'];
			$privacy=$row['privacy'];
			switch($privacy){
				case 0: $pri_content='Public Relationship to Everyone';
				break;
				case 1: $pri_content='Only Friends and Friends of them could see this Relationship';
				break;
				case 2: $pri_content='Only Friends could see this Relationship';
				break;
				case 3: $pri_content='Only Me could see this Relationship';
				break;
			}
			
			$a=mysqli_query($con,"select * from user natural join profile where userid='$other_userid'");
			$b=$a->fetch_assoc();
			$other_username=$b['username'];
			$other_realname=$b['realname'];
			$lastaccess=$b['lastaccess'];
			
?>
            <div class="col-sm-4 col-md-3">
              <div class="thumbnail">
                <div class="caption" style="height:250px">
                  <h3><a href="/page/<?=$other_userid?>"><?=$other_username?></a></h3>
                  <div style="height:100px">
                      <p>Real Name: <?=$other_realname?></p>
                      <p>Last Access: <?=$lastaccess?></p>
                  </div>
                  <p style="color:#646464"><small><?=$pri_content?></small></p>
                </div>
              </div>
            </div>
          
		
<?php
		}
    }
    
?>
</div>

</div>
</body>
</html>