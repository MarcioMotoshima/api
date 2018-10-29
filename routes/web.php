<?php

use Illuminate\Http\Request;


Route::get('/', function () {
    return view('login');
});
Route::get('/esqueci', function(){
    return view('esqueci');
});
Route::get('/cadastro', function(){
    return view('cadastro');
});
Route::get('/teste','MailController@enviarEmailCadastro');
   
