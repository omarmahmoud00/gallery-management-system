<?php

  
    class DB_Object{
        // protected static  $db_table = "user"; 
        // public $uploaded_directory="";  
        public  $errors = array() ;
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


        static function find_all(){
            global $db_connection ;
            return static::find_query("SELECT * FROM " . static::$db_table ." ");
        }

        static function find_by_id($id){
            global $db_connection;
          $result_array =  static::find_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
           
          return ! empty($result_array) ? array_shift($result_array): false ;
        }  

        
        static function find_query($sql){
            global $db_connection;
            $result = $db_connection->query($sql);
            $array_of_objects = array();
            while($row = mysqli_fetch_array($result)){

                $array_of_objects[] = static::instantiation($row);
            }
            return $array_of_objects ;

        }

        static function instantiation($the_record)
        {
            $user_object = new static;
 
            foreach($the_record as $property =>$value){

                if($user_object->has_the_attribute($property)){
                        $user_object->$property = $value;
                }
            }

            return $user_object;
             
        }

        private function has_the_attribute($the_property){

            $object_properties= get_object_vars($this);

            return array_key_exists($the_property,$object_properties);

        }


        
        protected function properties(){
            global $db_connection ; 
            $properties =  array();
            foreach (static::$db_table_fields as $db_field) {
                if (property_exists($this,$db_field)) {
                    // $db_connection->escape_query($this->$db_field)
                    $properties[$db_field]=$this->$db_field;
                }
            }

            return $properties;
        }



        function clean_properties(){
            global $db_connection;
            $cleaned= array();

            foreach ($this->properties() as $key => $value) {
                
                $cleaned[$key]=$db_connection->escape_query($value);
            }
            return $cleaned;
        }# end of the clean_ properties





        function save(){

            return isset($this->id) ? $this->update() : $this->create( );
        } 
  

        function create(){
            global $db_connection; 
             $properties = $this->clean_properties();        
            $sql ="INSERT INTO " . static::$db_table . " ( ".  implode(",",array_keys($properties)) .   " ) ";
            $sql.="VALUES ('" . implode("','",array_values($properties)) . "')" ;
                     
            $db_connection->query($sql);
            $this->id = $db_connection->insert_id();
            return (mysqli_affected_rows($db_connection->connection)==1) ? true : false ;   
        }
        
        
        
            function update(){
                global $db_connection ; 
                $properties = $this->clean_properties();    
                $properties_pairs = array();
                 foreach ($properties as $key => $value) {
                    $properties_pairs[]=" {$key}='{$value}' ";
                 }

 

                $sql ="UPDATE " . static::$db_table . " SET ";
                $sql.= implode(", ", $properties_pairs);
                $sql.=" WHERE id= " .$db_connection->escape_query($this->id)  ;
                 
                $db_connection->query($sql);
                return (mysqli_affected_rows($db_connection->connection)==1) ? true : false ; 


            }  //  the end of update function  
            
            function delete(){
                 
                global $db_connection;
                // $sql = "DELETE FROM . static::$db_table . WHERE  id= "
                //       .$db_connection->escape_query($this->id) 
                //       . " LIMIT 1";
                $sql = "DELETE FROM " . static::$db_table . " WHERE id = "
                        . $db_connection->escape_query($this->id) . " LIMIT 1";

                $db_connection->query($sql);
                return (mysqli_affected_rows($db_connection->connection)==1) ? true : false ; 
 
            }  // the end of delete function


            static function count_all(){
                global $db_connection;

                $sql = "SELECT COUNT(*) FROM " . static::$db_table;
                $result = $db_connection->query($sql);
                $row = mysqli_fetch_assoc($result);
                
                return array_shift($row) ;

            }
 
 



    } # end of the DB_Object class

       
     
// $dd = new DB_Object();

// $dd->save_photo("3");

?>