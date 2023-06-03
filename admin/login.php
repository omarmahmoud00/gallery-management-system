<?php include("includes/header.php"); ?>

<?php 

 
if ($session_object->getSigned_in()) {
  
      redirect("index.php");
} 
 
if ( isset($_POST['submit']) ) { 
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); 
    $user_found = User::verify_user($username, $password);  
           
    if ($user_found) { 
         $session_object->login($user_found);  
        redirect("index.php"); 
    } else {
         
        $message= "Your password or username is <br> INCORRECT!!"; 
    //   echo "you entered a wrong password  or user name "; 
    }
}
 else {   
    $message ="";
    $username = "";
    $password = "";
}

?>

<div class="col-md-4 col-md-offset-3">
    <h4 class ="bg-danger"> <?php  echo $message?> </h4>

    <h4 class="bg-danger"></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            
            <input type="text" class="form-control" name="username" 
              value="<?=  htmlspecialchars($_POST["username"] ?? "") ?>" >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password"   
            value="<?=  htmlspecialchars($_POST["password"] ?? "") ?>">
        </div>

        <div class="form-group">

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>

    </form>

</div>
