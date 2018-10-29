<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DisparoEmail;
class MailController extends Controller
{
    public function email(){
        return view('emailconta');
    }
    public function enviarEmailCadastro(){
        Mail::to('marcio.motoshima@gmail.com')->send(new DisparoEmail());
        return "Email Enviado com sucesso";
    }
}
