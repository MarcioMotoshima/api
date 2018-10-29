<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::resource('/produto', 'ProdutoController');
Route::resource('/usuario', 'UsuarioController');
Route::resource('/destaque', 'DestaqueController');

Route::get('/noticia',function(){
   $cats = DB::table('info')->get();
   foreach($cats as $cat){
       $dados = json_encode($cat);
   
    return  $dados;
   }
   $nomes = DB::table('usuarios')->pluck('nome');
   foreach($nomes as $dados2){
    echo $dados2."<br>";
   }
   $cats = DB::table('usuarios')->where('perfil',1)->get();
   foreach($cats as $cat){
       echo "Nome:".$cat->nome." ";
       echo "Pontos:".$cat->ponto . "<br>";

   }
   $cats = DB::table('info')->where('titulo','Laravel')->get(); 
   foreach($cats as $info){  
       $dados = json_encode($info);
      /* echo "Titulo: ".$cat->titulo;
       echo " Data: ".$cat->data;
       echo " Notícia: ".$cat->info;
       echo " Avatar: ".$cat->arquivo . "<br>";
       return  $dados;
    }
   

});
Route::get('/noticia/add',function(){
     DB::table('info')->insert([
        'titulo' => 'Marcio Motoshima Teste', 
        'data' => '28/10/2018', 
        'info' => 'Thiago vai aprender a programar games', 
        'arquivo' => 'thiago.png',
    ]);
}); 
Route::get('/noticia/add',function(){
    DB::table('info')->insert([
       'titulo' => 'Marcio Motoshima Teste', 
       'data' => '28/10/2018', 
       'info' => 'Thiago vai aprender a programar games', 
       'arquivo' => 'thiago.png',
   ]);
}); 
   
*/
Route::prefix('produto')->group(function(){
    //listar
    Route::get('','ProdutoController@index');
    //pegar pelo id
    Route::get('/{id}','ProdutoController@show');
    //criar produto
    Route::post('','ProdutoController@store');
    //atualizar produto
    Route::put('/{id}','ProdutoController@store');
    //deletar produto
    Route::delete('/{id}','ProdutoController@destroy');
});
Route::prefix('destaque')->group(function(){
    //listar
    Route::get('','DestaqueController@index');
    //pegar pelo id
    Route::get('/{id}','DestaqueController@show');
    //criar produto
    Route::post('','DestaqueController@store');
    //atualizar produto
    Route::put('/{id}','DestaqueController@store');
    //deletar produto
    Route::delete('/{id}','DestaqueController@destroy');    
});
Route::prefix('usuario')->group(function(){
    //listar
    Route::get('','UsuarioController@index');
    //pegar pelo id
    Route::get('/{cpf}','UsuarioController@show');
    //criar produto
    Route::post('add','UsuarioController@store');
    //atualizar produto
    Route::put('/{id}','UsuarioController@store');
    //deletar produto
    Route::delete('/{id}','UsuarioController@destroy');    
});