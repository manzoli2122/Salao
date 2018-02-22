<script>  
  $(function () {

    var chequeChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }




    var label_diario_pagamento_cheque = [], dados_diario_pagamento_cheque = [] 
    var ip = 0;
  @for ($i = 30; $i > 0; $i-- )
    label_diario_pagamento_cheque.push(["{{today()->subDays($i)->format('d/m')}} " ])    
    dados_diario_pagamento_cheque.push([ {{ Manzoli2122\Salao\Atendimento\Models\Pagamento::whereDate('created_at', [  today()->subDays($i)  ])->where('formaPagamento', 'cheque')->sum('valor') }}   ])
    ip = ip + 1;
  @endfor
  
  var area_diario_pagamento_cheque = {    
     
        labels  : label_diario_pagamento_cheque ,
        datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_pagamento_cheque
        } 
      ]
    }


    //-------------
    //- diario atendimento CHART -
    //--------------
    var diario_pagamento_chequeCanvas          = $('#diario_pagamento_cheque').get(0).getContext('2d')
    var diario_pagamento_chequeChart                = new Chart(diario_pagamento_chequeCanvas)
    var diario_pagamento_chequeChartOptions         = chequeChartOptions
    diario_pagamento_chequeChartOptions.datasetFill = false
    diario_pagamento_chequeChart.Line(area_diario_pagamento_cheque, diario_pagamento_chequeChartOptions)







  })
 
</script>