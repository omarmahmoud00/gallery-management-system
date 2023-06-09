<?php  ob_start();  ?>
<?php  include("init.php");  ?> 
  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

      <script src="js/scripts.js"></script> 



      <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session_object->count; ?> ],
          ['Comments',    <?php echo Comment::count_all(); ?> ] ,
          ['Users', <?php echo User::count_all(); ?>   ],
          ['photos',  <?php echo photo_class::count_all(); ?>   ] 
                      
        ]);

        var options = {
          legend:'non',
          pieSliceText:'label',
          backgroundColor:'transparent',
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>










</body>

</html>
