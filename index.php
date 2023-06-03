 
<?php include("includes/header.php");    ?>


        <div class="row">
           
    <?php
      $photos = photo_class::find_all(); 

       $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
       $items_per_page = 4;
       $items_total_count = photo_class::count_all();

       $paginate = new Paginate($page , $items_per_page, $items_total_count ); 

       $sql = "SELECT * FROM photos ";
       $sql .= "LIMIT {$items_per_page } ";
       $sql .= "OFFSET {$paginate->offset()}";

       $photos = photo_class::find_query($sql);
    ?>
         
            <!-- Blog Entries Column -->
            <div class="col-md-12">

            <div class="thumbnails row">

              <?php  foreach ($photos as $photo): ?>
 

                <div class="col-xs-6 col-md-3">

                <a class=" thumbnail" href="photo.php?id=<?php echo $photo->id; ?>" >
                <img class ="home_page_photo img-responsive "   src="<?php  echo"admin/".
                                                                 $photo->picture_path(); ?>"   alt="">

                </a>


                </div>
 

                <?php  endforeach; ?>  

                </div>

                <div class = "row">
                <ul class="pager">
                <?php  

                  if($paginate->page_total()>1){

                    if($paginate->has_next()) {
                        echo "<li class='next'> <a href='index.php?page={$paginate->next_page()}'>Next</a></li>";

                    }
                
                for ($i=1; $i <=$paginate->page_total() ; $i++) { 
                  # code...
                  if($i==$paginate->current_page){
                     echo "<li class='active'> <a href='index.php?page={$i}'> $i</a></li>"; 
                  }  else {
                    echo "<li class=''>  <a href='index.php?page={$i}'> $i</a> </li>"; 
                  }

                 


                }    
                    
                    
                        
                    if($paginate->previous_page()){
                       echo " <li class='previous'><a href='index.php?page={$paginate->previous_page()}'>Previous</a></li> "; 
                    }

                  } 
                ?>

             
                   
                   
                </ul>


                </div>
         

            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">

            
                 <?php // include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
