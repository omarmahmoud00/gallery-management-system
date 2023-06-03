 
<?php
    

    class User extends DB_Object{
        
    protected static  $db_table = "user"; 
    protected static $db_table_fields = array("user_name","password","first_name","last_name","user_image");
    public $id;
    public $user_name;
    public $password; 
    public $first_name;  
    public $last_name; 
    public $target_path;
    public  $tmp_path;
    public $user_image;        //"user_image",
    public $upload_directory= "images/user_images";
    public $image_placeholder="https://via.placeholder.com/150x150&text=image";


    public  $upload_errors_array = array(
        "File is uploaded successfully",
        "Uploaded file cross the limit",
        "Uploaded file cross the limit which is mentioned in the HTML form",
        "File is partially uploaded or there is any error in between uploading",
        "No file was uploaded",
        "Missing a temporary folder",
        "Failed to write file to disk",
        "A PHP extension stopped the uploading process"
    );


    public function set_file($file){

        if (empty($file) || !$file || !is_array($file) ) {
            # code...
            $this->errors[] = "there is no file uploaded here";
            return false ;
        } elseif ($file['error'] != 0) {
            # code...  
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;        
        } else { 
            $this->user_image = basename($file['name']); 
            $this->tmp_path = $file['tmp_name'];
            echo $this->user_image;
        } 
            
    } # E.O.M
    

     


    public function upload_photo(){
       
    
     if(!empty( $this->errors)) return false;
     if(empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = "the file was not available "; 
            return false;
     } 
     $this->target_path = SITE_ROOT . DS .'admin' . DS . $this->upload_directory . DS .$this->user_image ;
     
     if(file_exists($this->target_path)){
        $this->errors[]= " the file:" . $this->user_image ." is existed ";
      return false;
     } 

  

     if(move_uploaded_file($this->tmp_path , $this->target_path)){
         
              unset($this->tmp_path);  
              return true; 
     }else{

      $this->errors[] = "the file directory does not have a permission" ;
      return false;
     }
       
      
 
       } #E.O.upload_photo.M
   
           
    public function image_path_and_placeholder(){ 
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
  
        
        static function verify_user($user_name,$password){
            global $db_connection;
            $user_name=$db_connection->escape_query($user_name);
            $password=$db_connection->escape_query($password);

            $sql = "SELECT * FROM " . self::$db_table . " WHERE user_name = '{$user_name}' AND password = '{$password}' LIMIT 1";
 
            $result_array =  self::find_query($sql);
            return ! empty($result_array) ? array_shift($result_array): false ;



        }

        public function ajax_save_user_image($user_image,$user_id){

            $this->user_image=$user_image;
            $this->id = $user_id;
            $this->save();


        }














    
        }

    ?>    
