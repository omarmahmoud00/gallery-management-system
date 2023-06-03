<?php

   
       class photo_class extends DB_Object {
        protected static  $db_table = "photos"; 
        protected static $db_table_fields = array("title","caption","description", "filename",
                                                  "alternate_text", "type","size" );
        public $id;
        public $title;
        public $description; 
        public $filename;
        public $type;
        public $size;
        public $caption;
        public $alternate_text;


         public  $tmp_path;
         public  $uploaded_directory = "images";
         public  $target_path;
        

      // # this is a passing $_FILE['uploaded_file'] as an argument 

      public function set_file($file){

          if (empty($file) || !$file || !is_array($file) ) {
              # code...
              $this->errors[] = "there is no file uploaded here";
              return false ;
          }elseif ($file['error'] != 0) {
              # code...
              $this->errors[]= $this->upload_errors_array($file['error']); 
              return false;        
          } else{
              $this->filename = basename($file['name']);
              $this->tmp_path=$file['tmp_name'];
              $this->type=$file['type'];
              $this->size=$file['size'];
         
          }
          
          

      } # E.O.M

      public function picture_path(){

        return $this->uploaded_directory. DS . $this->filename ;
      }


      public function save(){
       if($this->id){

          $this->update();

      } else {

       if(!empty( $this->errors)) return false;
       if(empty($this->filename) || empty($this->tmp_path)) {
              $this->errors[] = "the file was not available ";
              return false;
       } 
       $this->target_path = SITE_ROOT . DS .'admin' . DS . $this->uploaded_directory . DS .$this->filename ;

       if(file_exists($this->target_path)){
        $this->errors[]= " the file:" . $this->filename ." is existed ";
        return false;
       }

       if(move_uploaded_file($this->tmp_path , $this->target_path)){

             if($this->create()){
                unset($this->tmp_path);
                return true;
             }
       }else{

        $this->errors[] = "the file directory does not have a permission" ;
        return false;
       }
        
      }


      } #E.O.save.M

      public function delete_the_photo(){

        if($this->delete()){
            $this->target_path = SITE_ROOT . DS .'admin'. DS . $this->picture_path;
            // echo $this->target_path;
        return unlink($this->target_path) ? true : false ;
        }else{
          return false;

        }


      } #E.O.delete_the_photo.M

      
       }  # E.O.C

  

?>

