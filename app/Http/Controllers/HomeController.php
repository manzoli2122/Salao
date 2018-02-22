<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redis;
use Mail;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $user_id =  session('users_id');

       // $user_redis = "users". $user_id;

       // $user = Redis::get($user_redis);

        //dd($user);

        return view('home');
    }


    public function home()
    {

        /*
        Mail::raw('teste mensagem do emai' , function($message){
            
            $message->from('manzoli.elisandra@gmail.com', 'Salao Espaco Vip');

            $message->to('manzoli2122@gmail.com')->subject('seja bem vindo');

        });
*/
        return view('graficos.atendimentos.atendimentos');
    }


    public function gastos()
    {
      
        return view('despesas');
    }


    public function pagamentos()
    {
      
        return view('graficos.pagamentos.pagamentos');
    }

 















    public function alterarSenha()
    {
        $user = Auth::user();
        return view('auth.passwords.alterarSenha', compact('user'));
    }


    public function updateSenha(Request $request)
    {
        $user = Auth::user();
        $dataUser = $request->all();           
        $dataUser['password'] = bcrypt($dataUser['password']);
        $update = $user->update($dataUser);     
        
        if($update){
            return redirect()->route('home')->with(['success' => 'Perfil atualizado com sucesso']);
        }        
        else {
            return redirect()->route('home')->withErrors(['errors' =>'Erro no Editar'])->withInput();
        }
    }


}
