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
    public function store(Request $request, Chat $chat)
    {
        dd($request);
        
    }
    // public function getData()
    // {
    //     $chats = Chat::orderBy('id', 'desc')->get();

    //     return $chats;
    // }
    
}
