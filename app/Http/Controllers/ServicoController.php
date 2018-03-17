<?php

namespace App\Http\Controllers;

use Manzoli2122\Salao\Cadastro\Ajax\Models\Servico;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;



class ServicoController extends BaseController
{    


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected $model;
    protected $name = "Servico";
   
    


    public function __construct(Servico $servico){
        $this->model = $servico;
    }




    public function index(){       
        return response()->json(['erro' => true , 'msg' =>"Dados encontrados com sucesso." , 'data' => $this->model->all() ], 200);
    }


    public function show($id){    
        try {            
            if(!$model = $this->model->findModelJson($id) ){
                $msg = __('msg.erro_nao_encontrado', ['1' =>  $this->name ]);
                return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
            }  
            return response()->json(['erro' => false , 'msg' =>'Item encontrado com sucesso.' , 'data' => $model  ], 200);  
           
        } catch(\Illuminate\Database\QueryException $e) {
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' =>  $this->name  , '2' => 'Model']):
                __('msg.erro_bd');
            return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
        }
    }
    
    



}
