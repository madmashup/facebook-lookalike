<?php 
require_once("header.php");
 ?>

<!-- <div id="bg"> -->
	
		<?php
		if(!empty($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<div class="col-md-8">
			<h3>Add a New Post</h3>
			<form method="post" class="clearfix" id="postform">
				<!-- <input type="text" name="post_title" class="form-control"> -->
				<textarea name="post_body" id="post_txt" class="form-control" style="margin-bottom:10px;"></textarea>
				<input type="reset" id="resetbtn"/>
				<input type="submit" value="Post" id="postbtn" class="btn btn-primary pull-right"/>
			</form>
			<div id="postbox">
				<?php
				require_once("connection.php");
				//$query=mysqli_query($conn,"SELECT * from posts order by created DESC");
				$query=mysqli_query($conn,"SELECT p.id as id, p.post, p.user_id, p.created, p.status, u.id as uid, u.name from feed as p INNER JOIN project as u ON p.user_id=u.id order by p.created DESC");
				//$query=mysqli_query($conn,"(SELECT p.*, u.id, u.name from posts as p LEFT JOIN users as u ON p.user_id=u.id order by p.created DESC) UNION (SELECT p.*, u.id, u.name from posts as p RIGHT JOIN users as u ON p.user_id=u.id order by p.created DESC)");
				while($fetch=mysqli_fetch_assoc($query)){
					// echo "<pre>";
					// print_r($fetch);
					// echo "</pre>";
					?>
					<div class="panel panel-primary">
						<div class="panel-heading">
							Posted By : <?php echo ucwords($fetch['name']) ?> | Posted On : <?php echo date("d F, Y - h:i:sa",strtotime($fetch['created'])) ?>
							<?php
							if($_SESSION['user']['id']==$fetch['user_id']){
								?>
								<a href="#" data-postid="<?php echo $fetch['id']; ?>" class="delete"><i class="glyphicon glyphicon-remove"></i></a>
								<?php
							}
							?>
						</div>
						<div class="panel-body">
							<?php echo $fetch['post'] ?>
						</div>
						<div class="panel-footer">
							<a href="#">Like</a> . 
							<a href="#">Share</a>
						</div>
					</div>
					<?php
				}
				?>	
			</div>
		</div>
		
	</div>
</div>


 <?php 
require_once("footer.php");
  ?>