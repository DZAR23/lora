<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::find($id);
        
        if (!$message) {
            abort(404); // O manejar el error de forma adecuada
        }
    
        return view('messages.show', [
            'message' => $message,
            'sender' => $message->sender,
            'receiver' => $message->receiver,
            'content' => $message->content,
            'created_at' => $message->created_at,
        ]);
    }
}