<?php
$postid=$_GET['post_id'];
require_once("connection.php");
$query=mysqli_query($conn,"DELETE from feed where feed.id=$postid");
if($query){
	echo 1;
}else{
	echo 0;
}
?>