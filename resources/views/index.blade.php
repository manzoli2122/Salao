@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Clientes			
@endsection


@push( Config::get('app.templateMasterCss' , 'css')  )			
	<style type="text/css">
		.btn-group-sm>.btn, .btn-sm {
			padding: 1px 10px;
			font-size: 15px;		
		}
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 4.8px;
		}
		label {			
			 margin-bottom: 1px; 
		}
	</style>
@endpush


@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success" id="div-box" >	
        <div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">
            <table class="table table-bordered table-striped table-hover table-responsive" id="datatable">
                <thead>
                    <tr>						
						<th>Nome</th>						
                        <th class="align-center" style="width:180px;min-width: 160px;">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push(Config::get('app.templateMasterScript' , 'script') )
    <script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>
	
	



	
    <script>
    	
			window.userShow = function(id, url , funcSucesso = function() {} ) {
				
						alertProcessando();
						var token = document.head.querySelector('meta[name="csrf-token"]').content;
	
						$.ajax({
							url: url + "/" + id,
							type: 'get',
							data: { _token: token },
							success: function(retorno) {
								alertProcessandoHide();
								if (retorno.erro) {
									toastErro(retorno.msg);
								} else {
									toastSucesso(retorno.msg);
									funcSucesso(retorno.data);
									
									
								}
							},
							error: function(erro) {
								alertProcessandoHide();
								toastErro("Ocorreu um erro");
								console.log(erro);
							}
						});
					
			}


			window.userShow = function(id, url , funcSucesso = function() {} ) {				
				alertProcessando();
				var token = document.head.querySelector('meta[name="csrf-token"]').content;
				$.ajax({
					url: url + "/" + id,
					type: 'get',
					data: { _token: token },
					success: function(retorno) {
						alertProcessandoHide();
						if (retorno.erro) {
							toastErro(retorno.msg);
						} else {
							toastSucesso(retorno.msg);
							funcSucesso(retorno.data);
						}
					},
					error: function(erro) {
						alertProcessandoHide();
						toastErro("Ocorreu um erro");
						console.log(erro);
					}
				});		
			}


			window.userVoltar = function( ) {	
				
				var htmltest = '<div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">';
				htmltest = htmltest + '<table class="table table-bordered table-striped table-hover table-responsive" id="datatable">';
				htmltest = htmltest + '<thead> <tr> <th>Nome</th> <th class="align-center" style="width:180px;min-width: 160px;">Ações</th>';
				htmltest = htmltest + '</tr> </thead> </table> </div>';
					

				document.getElementById("div-box").innerHTML = htmltest ;
				document.getElementById("div-titulo-pagina").innerHTML = "Clientes" ;
				document.getElementById("div-small-content-header").innerHTML = ""  ;	
				
				
				var dataTable = datatablePadrao('#datatable', {
					dom: "<'row'<'col-xs-12'<'col-xs-12'f>>>"+
						 "<'row'<'col-xs-12't>>"+
						 "<'row'<'col-xs-12'p>>",
					order: [[ 0, "asc" ]],
					ajax: { 
						url:'{{ route('usuarios.getDatatable') }}'
					},
					columns: [
						
						{ data: 'name', name: 'name' },
					
						
						{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
					],
				});
	
				dataTable.on('draw', function () {
					$('[btn-excluir]').click(function (){
						excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'tipo de seção'])", "{{ route('usuarios.apagados') }}", 
							function(){
								dataTable.row( $(this).parents('tr') ).remove().draw('page');
							}
						);
					});
	
					$('[btn-show]').click(function (){
						
						
						userShow($(this).data('id'), "{{ route('usuarios.index') }}",
							function(data){
								var htmltest = '<div class="box-body" >';
								htmltest = htmltest + '<div class="alert alert-default alert-dismissible align-center invisivel" >';
								htmltest = htmltest + '<label>Excluído</label> </div> <div class="align-right">';
								htmltest = htmltest + '<button type="button" class="btn btn-danger" id="btn-voltar" onclick="userVoltar()" > <i class="fa fa-times"></i> Voltar </button>';
								
										
									
	
								htmltest = htmltest + data['name'];
								htmltest = htmltest + '</div></div>';
								
								
								
								
								
								document.getElementById("div-box").innerHTML = htmltest ;
								document.getElementById("div-titulo-pagina").innerHTML = data['name'] ;
								document.getElementById("div-small-content-header").innerHTML = data['email'] + ' | ' + data['celular']   ;
								//console.log(document.getElementById("divAlerta").innerHTML);
							}
						);
	
					 
					});
	
	
	
				});

				
			}

	
		</script>
		




    
	<script>
		$(document).ready(function() {

			var dataTable = datatablePadrao('#datatable', {
				dom: "<'row'<'col-xs-12'<'col-xs-12'f>>>"+
            		 "<'row'<'col-xs-12't>>"+
            		 "<'row'<'col-xs-12'p>>",
				order: [[ 0, "asc" ]],
				ajax: { 
					url:'{{ route('usuarios.getDatatable') }}'
				},
				columns: [
					
					{ data: 'name', name: 'name' },
				
					
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'tipo de seção'])", "{{ route('usuarios.apagados') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});

				$('[btn-show]').click(function (){
					
					
					userShow($(this).data('id'), "{{ route('usuarios.index') }}",
						function(data){
							var htmltest = '<div class="box-body" >';
							htmltest = htmltest + '<div class="alert alert-default alert-dismissible align-center invisivel" >';
							htmltest = htmltest + '<label>Excluído</label> </div> <div class="align-right">';
							htmltest = htmltest + '<button type="button" class="btn btn-danger" id="btn-voltar" onclick="userVoltar()" > <i class="fa fa-times"></i> Voltar </button>';
							
									
								

							htmltest = htmltest + data['name'];
							htmltest = htmltest + '</div></div>';
							
							
							
							
							
							document.getElementById("div-box").innerHTML = htmltest ;
							document.getElementById("div-titulo-pagina").innerHTML = data['name'] ;
							document.getElementById("div-small-content-header").innerHTML = data['email'] + ' | ' + data['celular']   ;
							//console.log(document.getElementById("divAlerta").innerHTML);
						}
					);

                 
            	});



			});
        });
        


	</script>
@endpush