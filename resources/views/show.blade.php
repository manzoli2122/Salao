    
    <div class="box-body" style="background:#ecf0f5">
            
        <div class="alert alert-default alert-dismissible align-center invisivel" id="divAlerta">
            <label>Excluído</label>
        </div>
        <div class="align-right">
            <a href="{{route('clientes.atender', $model->id)}}" class="btn btn-success" title="Atender" remover-apos-excluir> 
                <i class="fa fa-money"></i> Atender
            </a>                    
            <button type="button" class="btn btn-danger" id='btnExcluir' remover-apos-excluir>
                <i class="fa fa-times"></i> Excluir
            </button>
            @permissao('clientes-editar')
                <a href="{{route('clientes.edit', $model->id)}}" class="btn btn-info" title="Editar" remover-apos-excluir> 
                    <i class="fa fa-pencil"></i> Editar
                </a>
            @endpermissao
            <a class="btn btn-default" href="{{ URL::previous() }}"><i class="fa fa-reply"></i> Voltar</a>

        </div> 

        <div class="box-header">			
            <h2>Últimos Atendimentos</h2>
        </div>           		
        
    </div>