<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
class ChatController extends Controller
{
    public function show()
    {
        return view('chats.show');
    }
}
