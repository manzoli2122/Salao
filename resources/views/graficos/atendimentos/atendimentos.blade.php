@extends('templates.templateMaster')

@section('content-header')
Bem Vindo ao Sistema do Salão Espaço Vip
@endsection

@section('small-content-header')
É um prazer Servir!!!!
@endsection

@section('content')

<div class="row">


  <div class="col-md-12">
   <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Gráfico do valor dos atendimentos diariamente</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="chart">
        <canvas id="diario_atendimento" style="height:250px"></canvas>
      </div>
    </div>
  </div>
</div>







<div class="col-md-6">
 <div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Gráfico do valor dos atendimentos diariamente Luzia</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="diario_atendimento_luzia" style="height:250px"></canvas>
    </div>
  </div>
</div>
</div>




<div class="col-md-6">
 <div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Gráfico do valor dos atendimentos diariamente Gleisiane</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="diario_atendimento_gringa" style="height:250px"></canvas>
    </div>
  </div>
</div>
</div>




<div class="col-md-6">
 <div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Gráfico do valor dos atendimentos diariamente Lusineia</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="diario_atendimento_lu" style="height:250px"></canvas>
    </div>
  </div>
</div>
</div>










</div>






@endsection





@push('script')

<script src="/js/chart.js"></script>

@include('graficos.atendimentos.gleisiane')

@include('graficos.atendimentos.lusineia')

@include('graficos.atendimentos.luzia')


<script>
  

  $(function () {
    


    var areaChartOptions = {
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
      pointDotStrokeWidth     : 2,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 5,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }




  	var label_diario_atendimento = [], dados_diario_atendimento = [] 
  	var ip = 0;
	 @for ($i = 30; $i > 0; $i-- )
		label_diario_atendimento.push(["{{today()->subDays($i)->format('d/m')}} " ])    
		dados_diario_atendimento.push([ {{ Manzoli2122\Salao\Atendimento\Models\Atendimento::whereDate('created_at', [  today()->subDays($i)  ])->sum('valor') }}   ])
		ip = ip + 1;
	@endfor
	








    var area_diario_atendimento = {    
     
        labels  : label_diario_atendimento ,
        
        datasets: [
        {
          label               : 'Total',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_atendimento
        } ,



         {
          label               : 'Lusineia',
          fillColor           : 'rgba(255, 214, 222, 1)',
          strokeColor         : 'rgba(255, 100, 110, 1)',
          pointColor          : 'rgba(255, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_atendimento_lu
        } 


         ,

         {
          label               : 'Gleisiane',
          fillColor           : 'rgba(210, 255, 222, 1)',
          strokeColor         : 'rgba(100, 255, 110, 1)',
          pointColor          : 'rgba(210, 255, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_atendimento_gringa
        } 

        ,

         {
          label               : 'Luzia',
          fillColor           : 'rgba(210, 214, 255, 1)',
          strokeColor         : 'rgba(100, 110, 255, 1)',
          pointColor          : 'rgba(210, 214, 255, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          //data                : dados_diario_atendimento
          data                : dados_diario_atendimento_luzia
        } 

        
      ]
    }


    //-------------
    //- diario atendimento CHART -
    //--------------
    var diario_atendimentoCanvas          = $('#diario_atendimento').get(0).getContext('2d')
    var diario_atendimentoChart                = new Chart(diario_atendimentoCanvas)
    var diario_atendimentoChartOptions         = areaChartOptions
    diario_atendimentoChartOptions.datasetFill = false
    diario_atendimentoChart.Line(area_diario_atendimento, diario_atendimentoChartOptions)







  })
 
</script>




@endpush
