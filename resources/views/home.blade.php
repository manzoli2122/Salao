@extends('templates.templateMaster')

@section('css')
<style>
    .content {
        background-image: url('images/logo-vip.png')!important ;
          background-repeat: no-repeat !important;
          background-attachment: scroll !important;
          background-size: cover  !important;
    }
</style>
@endsection

@section('content-header')
	Bem Vindo ao Sistema do Salão Espaço Vip
@endsection

@section('small-content-header')
	É um prazer Servir!!!!
@endsection

@section('content')

<section class="row text-center Listagens">   
	
	<div class="col-12 col-sm-8 lista">	
		<div class="col-12 col-sm-12 lista">
			<h2>
				ANIVERSARIANTES DO MÊS
			</h2>  				
			<table class="table table-bordered table-sm text-center">
				<tr class="thead-dark">
					<th>Aniversariantes</th>
					<th>Dia</th>
					<th>Aniversariantes</th>
					<th>Dia</th>								
				</tr>					
				@forelse( Manzoli2122\Salao\Atendimento\Models\Cliente::whereMonth('nascimento',now()->month)->ativo()->get()
					->sortBy(function ($usuario, $key) {
						return $usuario['nascimento']->day;
					}) as $user)
						@if($loop->iteration % 2 == 1 )						
							<tr>
								<td> {{$user->name}}</td>	
								<td> @if(isset($user->nascimento)) {{$user->nascimento->format('d/m')}} @endif </td>
								@if ($loop->last)
									</tr>
								@endif
						@else
								<td> {{$user->name}}</td>	
								<td> @if(isset($user->nascimento)) {{$user->nascimento->format('d/m')}} @endif </td>
							</tr>
						@endif				
				@empty
					<tr>						
						<td>Nenhum usuario encontrado</td>
					</tr>
				@endforelse
			</table>
		</div>
		
			
	</div>



	<div class="col-12 col-sm-4 lista">							
		<div class="col-12 col-sm-12 lista">
			<br> 
			<h2>
				INFORMAÇÕES
			</h2>  
			<h4 style="color:red;" > <b> NÃO USAR FIREFOX, USAR O CHROME </b></h4><br>
                      
      <h4> Para cadastro de <b> Produto, Serviço ou Operadora de cartão</b> selecionar o Cadastro no menu lateral da sua tela </h4><br>
      <!--p> Para recebimento de <b>Serviços anteriores</b> acesse o clientes e no menu Lateral, caso esteja a dívida cadastrada no sistema, aparecerá o valor da dívida. </p> <br><br-->			
		</div>
		
		
		<div class="col-12 col-sm-12 lista">							
				<table class="table table-bordered table-sm text-center">
					<tr class="thead-dark">			<th>Estatisticas</th>			<th>Valor</th>				</tr>
					<tr>						
						<td> Total de clientes</td>						
						<td> {{ App\User::count() }} </td>
					</tr>
					<tr>						
						<td> Novos Clientes</td>						
						<td> {{ App\User::whereBetween('created_at', [  now()->subMonth() , now()   ])->count() }} </td>
					</tr>
					<tr>						
						<td> Total de Tipos de Serviços</td>						
						<td> {{ Manzoli2122\Salao\Cadastro\Models\Servico::ativo()->count() }} </td>
					</tr>
					<tr>						
						<td> Total de Produtos </td>						
						<td> {{ Manzoli2122\Salao\Cadastro\Models\Produto::ativo()->count() }} </td>
					</tr>
				</table>				
			</div>



		<!--div class="col-12 col-sm-12 lista"></div>
		<div class="row" style="margin-top:800px">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<i class="fa fa-bar-chart-o"></i>
						<h3 class="box-title">Controle dos ultimos 30 dias</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div id="line-chart" style="height: 300px;"></div>
					</div>
				</div>
			</div>
		</div-->
	</div>      

	
</section>

@endsection
