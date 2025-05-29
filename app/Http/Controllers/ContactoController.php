<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        // Cambia la clave 'message' a 'mensaje' (o cualquier otro nombre)
        $data['mensaje'] = $data['message'];
        unset($data['message']); // Opcional, para que no haya duplicados

        Mail::send('emails.contacto', $data, function ($message) use ($data) {
            $message->to('tu-correo@mailtrap.io')
                ->subject('Mensaje de contacto: ' . $data['subject']);
            $message->from($data['email'], $data['name']);
        });

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}
