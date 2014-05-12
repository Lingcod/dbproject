<?php

    require_once 'utils.php';

    session_start();
    $userid=$_SESSION['userid'];
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['acts'])){
	$data = $_POST['acts'];
	foreach( explode(',',$data) as $aname){

	    $actid=act_in_db($aname);
	    if(!$actid){
		if(add_new_act($aname)){
		    $actid=$con->insert_id;
		}
		else echo 'insert activity failed';
	    } 
	    $con->query("insert into likeactivity(activityid,userid) values ($actid,$userid)");
	    var_dump($con);
	}
    }

function act_in_db($aname){
    global $con;
    if($result=$con->query("select * from activity where activityname='$aname'")){
	if($row = $result->fetch_assoc()){
	    return $row['activityid'];
	}
    }
    return false;
    
}

function add_new_act($aname){
    global $con;
    return $con->query("insert into activity(activityname) values ('$aname')");
}

?>


<form class="editprofile" action='/likeactivity.php' method="POST">
    <label for="acts" >Like activities(seperate with comma)</label>
<input type="text" name="acts" value="<?php echo get_act_str($userid); ?>" />
    <button type="submit" id="likeact-btn" name="likeact" value="Save" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
</form>
