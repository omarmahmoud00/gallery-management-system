<?php include("includes/init.php"); ?>
 
 <?php   
 if(!$session_object->getSigned_in()){  redirect("login.php"); }  ?>

<?php

    
    //  echo $_GET['id'] ; 
    
    if(empty($_GET['id'])){
        redirect("../photos.php"); 
     }

     $photo =  photo_class::find_by_id($_GET['id']); 
     echo $photo->$_GET['id'];
     if($photo){ 
        $photo->delete_the_photo();
        redirect("../photos.php");
     }else{ 
        redirect("../photos.php");
     }
 



?>