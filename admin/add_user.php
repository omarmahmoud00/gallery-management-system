<?php include("includes/header.php"); ?>
<?php if(!$session_object->getSigned_in()){  redirect("login.php");  }  ?>
<?php

 
 if(isset($_POST['create'])){
    $user = new User(); 
 

    if($user){
        $user->user_name = $_POST['user_name'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password =  $_POST['password'];
        $user->set_file($_FILES['user_image']);
        $user->upload_photo();
        $user->create();
 


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
          userS
          <small>Subheading</small>
        </h1>


        <form action="add_user.php" method = "post" enctype="multipart/form-data" >

        <div class = "col-md-6 col-md-offset-3 " >
             <div class = "form-group"> 
               <input type="file" name = "user_image" >   
               </div> 

            <div class = "form-group">
            <label for="username">user name</label>
               <input type="text" name = "user_name" class = "form-control" >
 
            </div> 

              <div class = "form-group">  
               <label for="first name">first name</label>
               <input type="text" name = "first_name" class = "form-control"  >

            </div> 
            
            <div class = "form-group">

               <label for="last name">last name</label>
               <input type="text" name = "last_name" class = "form-control" >

            </div>

            <div class = "form-group">

               <label for="password">password</label>
               <input type="password" name = "password" class = "form-control" >

            </div>

             <div class = "form-group">
 
               <input type="submit" name = "create" class ="btn btn-primary pull-right" >

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
