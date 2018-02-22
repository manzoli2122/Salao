@extends('templates.templateMaster')
@section('content-header')
	Altera a Senha
@endsection

@section('content')

<div class="col-sm-12">
    <h1 style=" text-align: center"> Alterar Senha</h1>

    	<form method="POST" action="{{route('senha.update')}}" accept-charset="UTF-8" class="form form-search form-ds">
    		{{ csrf_field() }}
            
			<div class="form-group">
                <input placeholder="Senha" class="form-control" name="password" value="" type="password">
			</div>
			<div class="form-group">
                <input placeholder="Confirmar Senha" class="form-control" name="password_confirmation" value="" type="password">
			</div>
				
			<div class="form-group">
                <input class="btn btn-success" value="Enviar" type="submit">
			</div>
        </form>

           
            
			
</div>


@endsection