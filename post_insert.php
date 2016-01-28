<?php
session_start();
$postdata=$_GET['data'];
parse_str($postdata,$final_data); //serialized data, array
//$title=$final_data['post_title'];
$post=$final_data['post_body'];
$user_id=$_SESSION['user']['id'];
if(!empty($post)){
	require_once("connection.php");
	$query=mysqli_query($conn,"INSERT into feed(user_id,post) VALUES($user_id, '$post')");
	$insertid=mysqli_insert_id($conn);//returns the primary key after last insert query
	if($query){
		?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				Posted By : <?php echo ucwords($_SESSION['user']['name']) ?> | Posted On : <?php echo date("d F, Y - h:i:sa",strtotime("now")) ?>
				<a href="#" data-postid="<?php echo $insertid; ?>" class="delete"><i class="glyphicon glyphicon-remove"></i></a>
			</div>
			<div class="panel-body">
				<?php echo $post; ?>
			</div>
			<div class="panel-footer">
				<a href="#">Like</a> . 
				<a href="#">Share</a>
			</div>
		</div>
		<?php
	}
}
?>