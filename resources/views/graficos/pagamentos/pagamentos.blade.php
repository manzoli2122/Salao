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
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_total" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>

 


  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Em dinheiro</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_dinheiro" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>



  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Em Cartão de credito</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_credito" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>





  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Em Cartão de debito</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_debito" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>






  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Em Cheque</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_cheque" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>






  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Fiados </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_fiado" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>





  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente Em Pic Pay </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_picpay" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>






  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Gráfico do valor dos pagamentos diariamente por Transferencia </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="diario_pagamento_transferencia" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>







</div>




		

@endsection





@push('script')

<script src="/js/chart.js"></script>

@include('graficos.pagamentos.total')
@include('graficos.pagamentos.dinheiro')
@include('graficos.pagamentos.credito')

@include('graficos.pagamentos.debito')

@include('graficos.pagamentos.cheque')

@include('graficos.pagamentos.fiado')

@include('graficos.pagamentos.picpay')

@include('graficos.pagamentos.transferencia')


@endpush
