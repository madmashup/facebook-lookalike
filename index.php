<?php 
require_once("header.php");

// if(!empty($_SESSION['user'])){
// 	$_SESSION['msg']="<div class='bg-error'>You must login to view that page.</div>";
// 	header("Location:home.php");
// }
 ?>

  <div class="container-fluid">
<?php
		if(!empty($_SESSION['msg']) && !empty($_GET['success'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		require_once("connection.php");
		if(!empty($_POST['submit'])){
			$name=$_POST['name'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$c_password=$_POST['c_password'];
			if(!empty($name) and !empty($email) and !empty($password)){
				if($password==$c_password){
					//$password=sha1($password);
					$query=mysqli_query($conn,"INSERT into project(id,name,email,password) VALUES(null, '$name','$email','$password')");
					if($query){
						$_SESSION['msg']="<div class='bg-success'>Record have been successfully added.</div>";
						header("Location:index.php?success=1");
					}else{
						echo "<div class='bg-danger'>Unable to save your record</div>";	
					}
				}else{
					echo "<div class='bg-danger'>Your password and confirm password do not match.</div>";
				}

			}else{
				echo "<div class='bg-danger'>Please fill in all the fields</div>";
			}


		}

		if(!empty($_POST['login'])){
			$email1=mysqli_real_escape_string($conn,$_POST['email1']);
			$password1=mysqli_real_escape_string($conn,$_POST['password1']);
			//$password=mysqli_real_escape_string($conn,($_POST['password']));
			$query=mysqli_query($conn,"SELECT * from project WHERE email='$email1' and password='$password1'");
			$rows=mysqli_num_rows($query);
			$data=mysqli_fetch_assoc($query);
			if($rows==1){
				unset($data['password']);
				if(!empty($_POST['keep'])){
					$time=time()+3600*24*30;
					setcookie("usercookie",$data['email'], $time);
				}
				$_SESSION['user']=$data;
				$_SESSION['msg']="<div class='bg-success'>Your are logged in !!</div>";
				header("Location:home.php");
			}else{
				echo "<div class='bg-danger'>Your Email and Password does not match!</div>";
			}
		}
		?>
 


<!--<div style="display:inline" class="col-sm-6 pull-left"><h1><strong>Facebook helps you connect and share with the people in your life.</strong></h1></div>

	<img class="img" src="images/fbconnect.png" alt="" width="537" height="195" />-->
<div id="index" class="col-sm-4" style=" width: 500px; margin-left:100px;">
<div style="font-weight:bold; display:inline; font-size:25px;"><strong>Facebook helps you connect and share with the people in your life.</strong></div>
<img class="img" src="images/fbconnect.png" alt="" width="537" height="195" />
</div>
<div id="regform" class="col-sm-6 pull-right">
  <div id="inform" class="col-sm-8 col-sm-offset-2">
    <h1><strong>Create an account</strong></h1>
    <h4>It's free and always will be.</h4>
    <form method="post">
      <div class="form-group">
        <label for="name">Enter Name :</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
      </div>
      <div class="form-group">
        <label for="">Enter Email :</label>
        <input type="email" class="form-control" id="" placeholder="Enter Email" name="email">
      </div>
      <div class="form-group">
        <label for="">Choose Password : </label>
        <input type="password" class="form-control" id="" placeholder="Choose Password" name="password">
      </div>
      <div class="form-group">
        <label for="">Confirm Password : </label>
        <input type="password" class="form-control" id="" placeholder="Confirm Your Password" name="c_password">
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Sign up" class="btn btn-success"/>
      </div>
    </form>
  </div>
</div>

<?php 
require_once("footer.php");
 ?>