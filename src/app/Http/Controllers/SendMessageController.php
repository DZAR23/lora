<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendMessageController extends Controller
{
    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del mensaje
        $request->validate([
            'receiver_email' => 'required|email|exists:users,email', // Validar el correo del destinatario
            'content' => 'required|string|max:1000',
        ], [
            'receiver_email.required' => 'El correo del destinatario es obligatorio.',
            'receiver_email.email' => 'Debe ingresar una dirección de correo electrónico válida.',
            'receiver_email.exists' => 'El destinatario con ese correo electrónico no existe.',
            'content.required' => 'El contenido del mensaje es obligatorio.',
        ]);

        // Obtener el usuario autenticado
        $sender = Auth::user();

        // Buscar el destinatario por correo electrónico
        $receiver = User::where('email', $request->input('receiver_email'))->first();

        // Crear un nuevo mensaje en la base de datos
        Message::create([
            'sender' => $sender->id,  // Usar el ID del usuario autenticado como remitente
            'receiver' => $receiver->id, // Usar el ID del destinatario
            'content' => $request->input('content'),
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->route('messages.index')->with('success', 'Mensaje enviado con éxito.');
    }
}