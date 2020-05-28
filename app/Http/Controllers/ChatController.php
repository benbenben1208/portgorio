<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Http\Requests\ChatRequest;
class ChatController extends Controller
{
    public function show()
    {
        return view('chats.show');
    }
    public function store(Request $request)
    {
        
        $chat = new Chat();
        $chat->message = $request->message;
        $chat->user_id = $request->user()->id;
        $chat->save();
        
        
    }
    public function getData()
    {
        $chats = Chat::orderBy('id', 'desc')->get();
        
        
    }
    
}
