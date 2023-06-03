<?php 
include("includes/header.php");
include("includes/photo_library_modal.php");
?>


<?php if(!$session_object->getSigned_in()){  redirect("login.php");  }  ?>
<?php

$user =User::find_by_id($_GET['id']); 
 if(empty($_GET['id']) || !isset($_GET['id'])){
    redirect("users.php");
 }

 if(isset($_POST['update'])){
  
    if($user){  
        $user->user_name = $_POST['user_name'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password =  $_POST['password'];

        if(empty($_FILES['user_image'])){
          $user->save();
        }else{
          $user->set_file($_FILES['user_image']); 
          $user->upload_photo();
          $user->save();
          redirect("edit_user.php?id={$user->id}");
        }

        
  
     } 
 
    }
  
 

?>
 

  

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <?php include("includes/top_nav.php"); ?>

  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <?php include("includes/side_nav.php"); ?>
  <!-- /.navbar-collapse --> 
</nav>

<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Users
          <small>Subheading</small>
        </h1>
 
        <div class="col-md-6 "> 
      
      <a href="#" data-toggle="modal" data-target= "#photo-library" ><img class = "img-responsive edit_user_image"
            src="<?php  echo $user->image_path_and_placeholder();?>" > </a>
      </div>

 
        
        
       <!-- edit_user.php -->
       <form action="" method="post" enctype="multipart/form-data" class="user-form">
  <div class="row">
    <div class="col-md-6 user-image">
      <div class="form-group">
    <label for="user_image" class="btn btn-primary">Choose file</label>
   <input type="file" name="user_image" id="user_image">

      </div>   
    </div>
    <div class="col-md-8 user-details">
      <div class="form-group">
        <label for="username">User name</label>
        <input type="text" name="user_name" class="form-control" value="<?php echo $user->user_name ?>">
      </div>
      <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
      </div>
      <div class="form-group">
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" value="<?php echo $user->password;   ?>">
      </div>
      <div class="form-group">
      <!-- <a id = "user-id"class="btn btn-primary  delete-button" href="delete_user.php?id=<?php echo $user->id;  ?>">delete</a> -->
      <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">delete</a>
      <input type="submit" name="update" class="btn btn-primary pull-right">
      </div>
    </div>
  </div>
</form>






      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>




 


 