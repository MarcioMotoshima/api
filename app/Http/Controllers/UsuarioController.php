<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class UsuarioController extends Controller
{
  
    public function index()
    {
        $usuarios = DB::table('usuarios')->where('perfil', 0)->get();
        return response($usuarios, 200);
    }

  
    public function create()
    {
        //
    }

  
    public function store(Request $request){
        header('Content-Type: application/json; charset=utf-8');
        $input = file_get_contents('php://input'); // Pega todos os dados do json
        $data = json_decode($input,true); // Decodifica o json e transforma em objeto
            $nome =  filter_var($data['nome'],FILTER_SANITIZE_STRING);
            $cpf =  filter_var($data['cpf'],FILTER_SANITIZE_STRING);
            $cpf = trim($cpf);
            $cpf = str_replace(array('.','-'),'',$cpf); 
            $email = filter_var($data['email'],FILTER_SANITIZE_EMAIL);                 
            $tel = filter_var($data['tel'],FILTER_SANITIZE_EMAIL);                    
            $niver = filter_var($data['niver'],FILTER_SANITIZE_STRING);
            $senha = filter_var($data['senha'],FILTER_SANITIZE_STRING);
            $banco = md5($senha); 
            $loja = "Via Celular";
            $id_usuario = "0";
            $banco = md5($senha);                        
            $perfil = "0";
            $ponto = "0";
            $datac = date('d/m/Y H:i');
            $tentativa = 3;                       
            DB::table('usuarios')->insert([
                'nome' => $nome,                
                'email' => $email,
                'senha' => $banco,
                'cpf' => $cpf,
                'perfil' => $perfil,  
                'tel' => $tel,
                'niver' => $niver,                
                'loja' => $loja,
                'ponto' => $ponto,                
                'datac' => $datac,
                'tentativa' => $tentativa,                
            ]);           
           Mail::send('emailconta', [],function($message){               
               $message->to($email);
               $message->subject('Olá Seja bem vindo Sr(a) ');
           });
            return "Cadastro OK";    
    }
   

   
    public function show($cpf){
        $cpf = trim($cpf);
        $cpf = str_replace(array('.','-'),'',$cpf);
        $usuarios = DB::table('usuarios')->where('cpf', $cpf)->where('perfil', 0)->get();
        $dados = count($usuarios);
        if($dados > 0){
            return response($usuarios,201);
        }else 
            return "Usuário não Cadastrado"; 
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
