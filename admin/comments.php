<?php include("includes/header.php"); ?>
<?php if(!$session_object->getSigned_in()){  redirect("login.php");  }  ?>
<?php

$comments = Comment::find_all();


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
          All Comments 
        </h1>
 
        <div class = "col-md-12" >
              
        <table class = "table table-hover " >
          <thead>
            <tr>
              <th> Id </th>
              <th> photo_id </th>
              <th> author Name </th>    
              <th> Body</th>   
            </tr>
            <tbody>

       <?php  foreach ($comments as $comment) :  ?>     
              <tr>
              <div class = "action-links"> 
                <td> <?php  echo $comment->id. "<br>"; ?> 

                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a> 
              </td> 
              </div> 
           
                   
                <td> <?php  echo $comment->photo_id; ?> </td> 
                <td> <?php  echo $comment->author; ?> </td> 
                <td> <?php  echo $comment->body; ?> </td> 
              </tr> 
       <?php endforeach; ?>          

            </tbody>

        </thead>  <!-- # E.O.T -->
        </table>


        </div>



      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
