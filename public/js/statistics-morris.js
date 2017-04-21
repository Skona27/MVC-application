/* MORRIS DONUT CHART
                  ----------------------------------------*/
                  Morris.Donut({
                      element: 'morris-donut-chart',
                      data: [{
                          label: "Returning",
                          value: <?=$data['sum_stats']['returning']?>
                      }, {
                          label: "New",
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
          labels: ['Visitors', 'Unique visitors'],
          fillOpacity: 0.6,
          lineWidth: 4,
          hideHover: 'auto',
          behaveLikeLine: true,
          resize: true,
          pointFillColors:['#ffffff'],
          pointStrokeColors: ['black'],
          lineColors:['#F39C12','#00a65a']
          
                });