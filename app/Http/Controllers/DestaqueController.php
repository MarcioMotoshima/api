<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Destaque;
class DestaqueController extends Controller
{
    
    public function index(){
      $destaques = DB::table('info')->get();      
      return response($destaques, 200);
    }

   
    public function create()
    {
        //
    }
  
    public function store(Request $request)
    {
        //
    }

 
    public function show($id){
        $destaques = DB::table('info')->where('id', $id)->get();
        $dados = count($destaques);
        if($dados > 0){
            return response($destaques,201);
        }else 
            return "Destaques não Cadastrado";   
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
