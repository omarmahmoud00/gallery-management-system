<?php

// Define database connection constants 
if (!defined('DB_HOST')) {
  define('DB_HOST', 'localhost');
}

if (!defined('DB_USERNAME')) {
  define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
  define('DB_PASSWORD', '');
}

 if (!defined('DB_NAME')) {
  define('DB_NAME', 'gallery_db');
  }

// Create a connection to the database

try { 
  $connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection->connect_error) {
  throw new Exception("Failed to connect to MySQL: " . $connection->connect_errno);
} 
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}


  return  $connection;
?>