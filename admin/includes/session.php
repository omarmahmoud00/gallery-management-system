<?php


class the_session {

 private $signed_in= false;
  public  $user_id;
  public $message;
  public $count;





    function __construct(){
        session_start();
       $this->check_login();  
       $this->visitor_count();

    }

    function visitor_count(){

        if(isset($_SESSION['$count'])){
    
            return $this->count = $_SESSION['$count']++; 
    
        }else{
            return $_SESSION['$count'] = 1;
        }
    
      }

 

   public function  getSigned_in(){

        return $this->signed_in;

    }

    function login($user){
        // user_id
        if($user){                     
            $this->user_id=$_SESSION['user_id'] = $user->id  ;
            $this->signed_in=true;
        }    
    }

    function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $signed_in= false;
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id=$_SESSION['user_id'];
            $this->signed_in = true;
        } else{
            unset($this->user_id);
            $this->signed_in = false;
        }
        
    }

    public function get_message($msg=""){
        if(!empty($msg)){
            $_SESSION['message']=$msg;
        }
        else{
            return $this->message;
        }
    }

    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->$message=$_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message="";
        }
    }


}



$session_object = new the_session(); 


?>