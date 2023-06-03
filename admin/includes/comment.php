 
<?php
    

    class Comment extends DB_Object{
        
    protected static  $db_table = "comments"; 
    protected static $db_table_fields = array("id","photo_id","author","body");
    public $id;
    public $photo_id;
    public $author; 
    public $body; 




    public static function create_comment($photo_id_arg, $author_arg , $body_arg ) {  
        if (!empty($photo_id_arg) && !empty($author_arg) && !empty($body_arg)) { 
            $comment_obj = new Comment();
            $comment_obj->photo_id = (int)$photo_id_arg;
            $comment_obj->author = $author_arg;
            $comment_obj->body = $body_arg; 
            return $comment_obj;
        }else{  
            return false;
        }

    }#End of the create_comment method


    public static function find_the_comments($photo_id) {
        global $db_connection;
       if(empty($photo_id)) return false;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE photo_id = ". $db_connection->escape_query((int)$photo_id);
        $sql .= " ORDER BY photo_id ASC";

        return self::find_query( $sql);
    }

    

 
 
        
    
        } #End of the Comment class

    ?>    
