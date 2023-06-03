 <?php



function my_auto_loader($className) {
    $filename = "includes/{$className}.php";
    if (file_exists($filename)) {
        require_once $filename;
    }else{
        die("the {$className} not found");
    }
}

spl_autoload_register('my_auto_loader');

  function redirect($location){
    header("Location:{$location}");
  }

?>