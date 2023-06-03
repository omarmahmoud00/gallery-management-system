

<?php

class DataBase {
    public $connection;

    function __construct() {
        $this->open_db_connection();
    }

    function open_db_connection() {
        $this->connection = require __DIR__ . "/config.php";

        if ($this->connection->connect_error) {
            die("Failed to connect to MySQL: <br> ("  . "error's number: " . 
            $this->connection->connect_errno . ") <br> ". $this->connection->connect_error );
        } 
    }

    function query($sql) {
        $result = $this->connection->query($sql);
        if (!$result) {
            die("failed" . $this->connection->connect_error );
        }
        return $result;
    }

    function escape_query($string) {
        return $this->connection->real_escape_string($string);    
    }
    function insert_id(){
       
        return  mysqli_insert_id($this->connection);
    }




    // function insert_to_database($sql, $array){
            
    //     $stm=$this->connection->stmt_init();
    //     if(! $stm->prepare($sql)){

    //         die("sql error " . $db_connection->error );
    //        }
    //        for ($i=0; $i <count($array) ; $i++) { 
    //       $array[$i]= self::escape_query( $array[$i]); 
    //        }
           

    //       $stm->bind_param("ssss",  $array[0] , 
    //                          $array[1],
    //                          $array[2] ,
    //                          $array[3]);

    //        try {
    //                       if (!$stm->execute()) { 
                         
    //                       die("Error: " . $this->connection->error . " (" . $this->connection->errno . ")");
    //                      }
                         
    //                          exit();  
                           


    //                      } catch (mysqli_sql_exception $e) {
    //                             if ($e->getCode() == 1062) {
    //                              die("Email address already exists. Please use a different email address.");
    //                             } else {
    //                              die("Error: " . $e->getMessage());
    //                             }
    //                   }                   

    // }

} // E.O.C

$db_connection = new DataBase();
// $db_connection->insert_to_database();
// print_r($db_connection->query("SELECT * FROM  user"))
?>
