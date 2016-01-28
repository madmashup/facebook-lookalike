<?php
$word=$_GET['w'];
require_once("connection.php");
$query=mysqli_query($conn,"SELECT post,created from feed where post like '$word%'");
$count=mysqli_num_rows($query);
if($count>0){
	while($fetch=mysqli_fetch_assoc($query)){
		echo "<li><p>".substr($fetch['post'], 0, 100)."...</p><h4>Posted on : ".date("F d, Y - h:i:sa",strtotime($fetch['created']))."</h4></li>";
	}
}else{
	echo "<li>Nothing found!!</li>";
}
?>