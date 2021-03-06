<?php
    require_once 'utils.php';


    if($_SERVER['REQUEST_METHOD']=='POST'){
	$userid=$_POST['userid'];
	$objid=$_POST['objid'];
	$type=$_POST['type'];
	if($userid && $objid && $type){
	    header('Content-Type: application/json');
	    echo json_encode(array('id'=>$objid, 'type'=>$type, 'result'=>toggle_like($userid,$objid,$type), 'like_num'=>like_num($objid,$type)));
        }
    }

    function toggle_like($userid, $objid, $type){
	global $con;
	if($type=='diary'){
	    if(is_liked($userid, $objid, $type)){
		if($con->query("delete from likediary where (diaryid, userid)=($objid, $userid)")){
		    return false;
		}
		else return true;
	    }
	    else{
		if($con->query("insert into likediary(diaryid, userid) values($objid, $userid)")){
		    return true;
		}
		else return false;
	    }

	}
	elseif($type=='actloc'){
	    if(is_liked($userid, $objid, $type)){
		if($con->query("delete from likeactloc where (actlocid, userid)=($objid, $userid)")){
		    return false;
		}
		else return true;
	    }
	    else{
		if($con->query("insert into likeactloc(actlocid, userid) values($objid, $userid)")){
		    return true;
		}
		else return false;
	    }

	}

    }



    function is_liked($userid, $objid, $type){
	global $con;
	switch($type){
	    case 'diary':
		$result=$con->query("select * from likediary where userid=$userid and diaryid=$objid");
		break;

	    case 'actloc':
		$result=$con->query("select * from likeactloc where userid=$userid and actlocid=$objid");
		break;
	}
	if($result){
	    if($result->num_rows>0) 
		return true;
	    else
		return false;
	}
	else return false;
    }


    function like_btn($userid,$objid, $type){
	if($userid){
	    $liked=is_liked($userid, $objid, $type);
	    if($liked) 
		$css = 'liked';
	    else 
		$css = '';
	}
	else{
	    $liked=false;
	    $css = 'login_required';
	}

	echo ''?>
    <div>
	<button class="btn btn-link btn-like <?=$css?>" data-userid="<?=$userid?>" data-type="<?=$type?>" data-id="<?=$objid?>" >
	    <span class="glyphicon glyphicon-thumbs-up"></span><?php echo $liked? 'liked':'like'; ?>
	</button>
	    <small style="margin: 0px; padding: 0px;" class="like-num" data-type="<?=$type?>" data-id="<?=$objid?>" ><?php if($liked) echo like_num($objid, $type)." people liked this"; ?></small>
    </div>

<?php
    ;}

function like_num($objid, $type){
    //type can only be  'diary', 'activity' or 'actloc'
    global $con;
    $result=$con->query(" select * from like{$type}_num where {$type}id=$objid");
    if($result){
	return $result->fetch_assoc()['like_num'];
    }
    else return '';
}

?>
