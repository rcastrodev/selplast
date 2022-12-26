<?php

namespace App\Http\Controllers;

use App\Data;
use App\Client;
use App\Mail\QuoteEmail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{   
    public function contact(Request $request)
    {
        
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'nombre'    => 'required',
            'email'    => 'required',
            'telefono'  => 'required',
            'mensaje'   => 'required',
        ],[
            'g-recaptcha-response.required' => 'Debe validar que no es un robot',
            'g-recaptcha-response.captcha'  => 'Debe validar que no es un robot',
            'nombre.required'               => 'Nombre es requerido',
            'email.required'               =>  'Email es requerido',
            'telefono.required'             => 'Correo es requerido',
            'mensaje.required'              => 'Mensaje es requerido',
        ]);

        $email = Data::first()->email;

        $data = $request->all();
        if($request->hasFile('file'))
            $data['file'] = $request->file('file')->store('file_email', 'public');
        
        if(isset($email)){
            try {
                Mail::to($email)  
                    ->send(new ContactMail($data));
                
                $mensaje = 'Correo enviado, nuestro equipo se pondra en contacto con usted';
                $class = 'success';
    
            } catch (\Throwable $th) {
                $mensaje = 'Error al enviar correo';
                $class = 'danger';
                Log::error($th->getMessage());
            }
        }else{
            $mensaje = 'Error al enviar correo';
            $class = 'danger';            
        }

        return back()
            ->with('mensaje', $mensaje)
            ->with('class', $class);
    }
}