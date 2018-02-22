<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Manzoli2122\Pacotes\Http\Controller\DataTable\Json\SoftDeleteJsonController ;
use DataTables;
use ChannelLog as Log;

class UserController extends SoftDeleteJsonController
{
    
   // protected $model;    
    protected $name = "User";    
    protected $view = "";  
    //protected $view_apagados = "atendimento::clientes.apagados";  
    protected $route = "usuarios";
   
    //protected $logCannel;


    public function __construct(User $user){
        $this->model = $user;              
    } 


   



}
