<?php
    require_once 'utils.php';
    require_once 'header.php';
    if($isguest){
	die("need to login first");
    }

	$search_type = isset($_POST['type']) ? $_POST['type'] : '';
	$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    $userid=$_SESSION['userid'];
    
?>

<html>
<head>
  <title>Search - Wildbook</title>
  <link rel="shortcut icon" href="icon.gif">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="global.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
<form method="POST" action='/search.php'>
	<div class="row">
    <div class="col-lg-6">
    <input type="text" class="form-control" name="keyword" value="" />
    </div>
    <select name="type" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	<option value="0">People</option>
	<option value="1">Diary</option>
    </select>
    <button type="submit" value="Post" class="btn btn-primary">Submit</button>
    </div>
</form>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
	$haveresult=false;
	if($search_type=='0'){
	    $people_list = $con->query("select * from user natural join profile where privacy<=getrelation(userid,$userid) and ( realname like '%{$keyword}%')"); 
	    if($people_list){
		while($people=$people_list->fetch_assoc()){
		    $haveresult=true;
		?>
		<div class="list-group">
		<?php 
 ?>
                <div class="list-group-item">
                <h3><a href="/page/<?=$people['userid']?>"><?=$people['username']?></a><small> Real name: <?=$people['realname']?>, Age: <?=$people['age']?>, City: <?=$people['city']?></small></h3>
                </div>

<?php		
		}
		?>
		</div>
<?php
	    }
	    
	}
    elseif ($search_type=='1'){
	$diary_list = $con->query("select * from user natural join diary  where  privacy<=getrelation(userid,$userid) and (title  like '%$keyword%' or content like '%$keyword%') order by posttime desc"); 
	if($diary_list){
	    while($diary=$diary_list->fetch_assoc()){
			$diaryid=$diary['diaryid'];
			$result = $con->query("select abstract from news where tablename ='diary' and pk = $diaryid");
			$abstract = $result->fetch_assoc();
		    $haveresult=true;
?>
	    <div class="list-group">
          <div class="list-group-item">
          <h3><a href="/diary/<?=$diary['diaryid']?>"><?=$diary['title']?></a></h3>
          <small><?=$abstract['abstract']?></small>
          </div>
        
        
        
        
        
        
	    <?php 
	    }
	    ?>
	    </div>

<?php
    
	    }
	}
	if(!$haveresult){
	    echo "nothing found here";
	}
    }
?>
</div>
</body>
</html>

