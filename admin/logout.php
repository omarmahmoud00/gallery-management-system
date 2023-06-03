<?php include("includes/header.php"); ?>
<?php

$session_object->logout();
redirect("login.php");
 
?>