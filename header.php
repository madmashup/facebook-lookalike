<?php 
session_start();
 ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
	<title>Welcome to Facebook- Log In, Sign Up or Learn More</title>
</head>
<body>
  <div class="container-fluid">
<div><nav style="padding-left:40px; padding-right:40px;" class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span class="image"><img src="images/facebook_logo.png" alt="Facebook Logo"/></span><strong style="color:#FFFFFF;">Facebook</strong>  <i class="glyphicon glyphicon-sunglasses" style="color:#FFFFFF;"></i></a>
    </div>

    
<?php
        if(!empty($_SESSION['user']['name'])){
          ?>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="#">All Posts</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Edit Profile</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> 
                <?php             
                echo ucwords($_SESSION['user']['name']);
                ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php" class="">Logout</a></li>

                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left pull-right" role="search">
              <div class="form-group search_wrap">
                <input type="text" class="form-control" id="searchbar" placeholder="Search here"/>
                <ul id="search_result">
                </ul>
              </div>
            </form>
            <?php
          }
          else{
          ?>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <form class="form-inline" action="" method="post">
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" name="email1">
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password" name="password1">
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"><label style="color:#ffffff;">Remember me</label>
            </label>
          </div>
          <input id="login" type="submit" class="btn btn-default" name="login" value="Login">
      </form>

      <?php 
    }
       ?>
        <!--<li><a href="#">edit profile</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">username <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Logout</a></li>-->

          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav></div>

<?php
    if(empty($_SESSION) && isset($_COOKIE['usercookie'])){
      require_once("connection.php");
      $cookie=$_COOKIE['usercookie'];
      $query=mysqli_query($conn,"SELECT * from project where email='$cookie'");
      if($query){
        $fetch=mysqli_fetch_assoc($query);
        unset($fetch['password']);
        $_SESSION['user']=$fetch;
        header("Location:home.php");
      }
    }
    ?>