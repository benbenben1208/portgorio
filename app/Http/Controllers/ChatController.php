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
        $chatted_user = $request->user();

        $group = Group::whereExistGroup($user, $chatted_user)->first();
        
        if (!$group) {
            $group = Group::create(['name' => $user->name . 'と' . $chatted_user->name]);
            $group->users()->attach([$user->id, $chatted_user->id ]);
        }

        $group->load('users');      

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
    public function destroy(Chat $chat)
    {
        $chat->delete();
        // $chat = Chat::where('id', $id)->delete();
     
    }
    
}
