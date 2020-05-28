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
    public function store(ChatRequest $request)
    {
        
        $chat = new Chat();
        $chat->create($request->validated()+ [
            'user_id' => $request->user()->id 
            ]);
    }
    public function getData()
    {
        $chats = Chat::with('user:id,name')->orderBy('created_at', 'desc')
            ->get();
        
        return $chats;
        
    }
    
}
