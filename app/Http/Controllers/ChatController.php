<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Chat;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChatRequest;
class ChatController extends Controller
{
    public function show(Request $request, User $user, Group $group)
    {
        DB::transaction(function () use ($request, $user) {
             $user2 = $request->user();
             $group = Group::with('users')->firstOrCreate([
            'name' => $user->name . 'と' . $user2->name,
          ]);
            
            $group->users()->detach([$user->id, $user2->id]);
            $group->users()->attach([$user->id, $user2->id]);

            
        });
            return view('chats.show', compact('group'));
  
    }
    public function showIsChatted(Request $request, User $user, Group $group)
    {
        return view('chats.show', compact('group'));
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
