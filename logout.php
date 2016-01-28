<?php
session_start();
session_destroy();
setcookie("usercookie","",time());
header("Location:index.php");
?>