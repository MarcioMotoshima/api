<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
   
    public function index()
    {
        $produtos = DB::table('produtos')->get();
        return response($produtos, 200);
    }

   
    public function create()
    {
        return "formulário para Cadastro de produtos";
    }

    
    public function store(Request $request)
    {
       
    }

 
    public function show($id)
    {
        $produtos = DB::table('produtos')->where('id', $id)->get();
        $dados = count($produtos);
        if($dados > 0){
            return response($produtos,201);
        }else 
            return "Produto não Cadastrado";     
    }   

  
    public function edit($id)
    {
        
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
