<?php
    require_once 'utils.php';
	$lastaccess = $_SESSION['lastaccess'];
	$userid = $_SESSION['userid'];
    $result=mysqli_query($con, "select * from profile natural join user where  (privacy<=getrelation(userid, $userid) or privacy is NULL) and userid='$pageid';");
    
    if($result){
	//TODO: maybe it should be clear whether it's hidden or it has not been set yet.
	
		while($row=$result->fetch_assoc()){
			$this_person_id=$row['userid'];
			$result=mysqli_query($con, "select * from friendship where maker='$userid' and makee='$this_person_id';");
			$relationship=$result->fetch_assoc();
	?>
	
	  <div class="jumbotron">
			<div>
				<h3><strong><?=$row['username']?></strong><h3>
			</div>
			<div>
				<strong>Name: </strong><?=$row['realname']?>
			</div>
			<div>
				<strong>Age: </strong><?=$row['age']?>
			</div>
			<div>
				<strong>City: </strong><?=$row['city']?>
			</div>
			<div>
				<strong>Last Access: </strong><br><?=$lastaccess?>
			</div>
			<div>
		    <strong>Like:</strong><?php echo get_act_str($pageid); ?>
			</div>
            <br>
            <a href="/friendship?page=<?=$_GET['pageid']?>"><span class="glyphicon glyphicon-heart-empty"></span> His/Her Friends</a><br>
<?php
			if($this_person_id!=$userid){
				if($relationship){
?>
					<a class="btn btn-link" href="/send_message?receiverid=<?=$row['userid']?>"><span class="glyphicon glyphicon-send"></span> Send Message</button></a><br>
				
<?php
				}
				else{
?>	   
					<a class="btn btn-link" href="/add_friend?receiverid=<?=$row['userid']?>"><span class="glyphicon glyphicon-record"></span>Add Friend</button>
		   
		
<?php
				}
			}
		}
    }

?>
		</div>
