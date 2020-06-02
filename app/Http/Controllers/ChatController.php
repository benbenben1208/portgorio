<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
    public function store(ChatRequest $request, Group $group)
    {
            $chat = new Chat();
        if ($request->photo) {
            $chats_photo = time() . '.' . $request->photo->getClientOriginalName();
            $request->photo->storeAs('public/chats_images',  $chats_photo);
            $chat->img_path =  '/storage/chats_images/' . $chats_photo;
        }

        
        
        $chat->fill($request->validated()+ [
            'user_id' => $request->user()->id,
            'group_id' => $group->id,
            ])->save();

        return ['success' => '登録しました'];    
        
    }
    public function getData(Group $group)
    {
        
        $chats = Chat::with('user:id,name')->where('group_id', $group->id)->orderBy('created_at', 'desc')
            ->get();
        $auth_user = Auth::user();

        return  [
            'chats' => $chats,
            'auth_user' => $auth_user,
        ];
        
    }
    public function destroy(Chat $chat)
    {
        $chat->delete();
        
     
    }
    
}
