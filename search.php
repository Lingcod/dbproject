<?php
    require_once 'utils.php';
    require_once 'header.php';
    if($isguest){
	die("need to login first");
    }

    $search_type=$_POST['type'];
    $keyword=$_POST['keyword'];
    $userid=$_SESSION['userid'];
    
?>
<form method="POST" action='/search.php'>
    <input type="text" name="keyword" value="" />
    <select name="type" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	<option value="0">People</option>
	<option value="1">Diary</option>
    </select>
    <button type="submit" value="Post" class="btn btn-primary">Submit</button>

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
		<div>
		<?php 
			foreach($people as $i){ echo $i; }
		    }
		?>
		</div>
<?php
	    }
	    
	}
    elseif ($search_type=='1'){
	$diary_list = $con->query("select * from user natural join diary  where  privacy<=getrelation(userid,$userid) and (title  like '%$keyword%' or content like '%$keyword%')"); 
	if($diary_list){
	    while($diary=$diary_list->fetch_assoc()){
		    $haveresult=true;
?>
	    <div>
	    <?php 
		    foreach($diary as $i){ echo $i; }
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


