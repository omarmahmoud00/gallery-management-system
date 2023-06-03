<?php include("includes/init.php"); ?>
 
 <?php   
 if(!$session_object->getSigned_in()){  redirect("login.php"); }  ?>

<?php

      if(empty($_GET['id'])){
        redirect("users.php"); 
     }

     $user =  User::find_by_id($_GET['id']); 
     echo $user->$_GET['id'];
     if($user){ 
        $user->delete();
        redirect("users.php");
     }else{ 
        redirect("users.php");
     }


?>