<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Obtener todos los mensajes enviados y recibidos por el usuario autenticado
        $messages = Auth::user()->sentMessages()
            ->orWhere('receiver', Auth::id())
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::find($id);
        
        if (!$message) {
            abort(404); // O manejar el error de forma adecuada
        }
        
        // Verificar que el mensaje pertenece al usuario autenticado
        if ($message->sender != Auth::id() && $message->receiver != Auth::id()) {
            abort(403); // Acceso denegado si el mensaje no pertenece al usuario autenticado
        }

        return view('messages.show', [
            'message' => $message,
            'sender' => $message->senderUser, // Relación definida en el modelo Message
            'receiver' => $message->receiverUser, // Relación definida en el modelo Message
            'content' => $message->content,
            'created_at' => $message->created_at,
        ]);
    }

    public function store(Request $request)
    {
        // Validar la solicitud entrante
        $validated = $request->validate([
            'receiver' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Crear un nuevo mensaje asociado al usuario autenticado
        $message = Auth::user()->sentMessages()->create(array_merge($validated, ['sender' => Auth::id()]));

        return redirect()->route('messages.index')->with('success', 'Mensaje enviado con éxito.');
    }
}
