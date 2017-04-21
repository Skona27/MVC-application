            </div>
          </div>
				 <footer>
          <span>&copy; <?=date("Y")?> IKSEL Studio Reklamy &middot; Wszelkie prawa zastrzeżone.</span>
          <span class="pull-right">Wersja: <?=Config::get('version')?></span>
         </footer>
				</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?=Config::get('path/public')?>js/jquery-1.11.1.min.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?=Config::get('path/public')?>js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?=Config::get('path/public')?>js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="<?=Config::get('path/public')?>js/custom-scripts.js"></script>
    <script src="<?=Config::get('path/public')?>js/morris.js"></script>
    <script src="<?=Config::get('path/public')?>js/raphael.js"></script>

      <?php 
      if(isset($data['js'])) {
        foreach($data['js'] as $js) {
          echo '<script src="' . Config::get('path/public') . 'js/' . $js . '"></script>';
        }
      }
      ?>

  <?php
      if($data['active'] === 'dashboard'):
    ?>
      <script>
        /* MORRIS DONUT CHART
                  ----------------------------------------*/
                  Morris.Donut({
                      element: 'morris-donut-chart',
                      data: [{
                          label: "Powracający",
                          value: <?=$data['sum_stats']['returning']?>
                      }, {
                          label: "Nowi",
                          value: <?=$data['sum_stats']['new']?>
                      }],
                         colors: [
          '#F39C12','#00a65a',
          '#A8E9DC' 
        ],
                      resize: true
                  });

                 /* MORRIS LINE CHART
                ----------------------------------------*/
                Morris.Line({
                    element: 'morris-line-chart',
                    data: [
                    <?php foreach ($data['all_stats'] as $stat): ?>                  
                          { year: '<?=$stat->date?>', a: <?=$stat->total_visitors?>, b: <?=$stat->unique_visitors?>},
                    <?php endforeach; ?>      
                    ],
                
                     
          xkey: 'year',
          ykeys: ['a', 'b'],
          labels: ['Użytkownicy', 'Unikalni użytkownicy'],
          fillOpacity: 0.6,
          lineWidth: 4,
          hideHover: 'auto',
          behaveLikeLine: true,
          resize: true,
          pointFillColors:['#ffffff'],
          pointStrokeColors: ['black'],
          lineColors:['#F39C12','#00a65a']
          
                });
      </script>
    <?php
      endif;
    ?>
   
</body>
</html>