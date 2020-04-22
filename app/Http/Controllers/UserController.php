<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{
    public function show(User $user)
    {
        

        return view('users/show', compact('user'));
    }
    public function edit(User $user)
    {
        
        return view('users.edit', compact('user'));
    }
    public function update(UserRequest $request, User  $user)
    {
        
        $user->name = $request->name;

            if($request->user_profile_photo) {
                $user_images_store = $request->user_profile_photo->storeAs('public/user_images', $user->id . 'jpg');
                $user->profile_photo = basename($user_images_store);
            }

           
            
            
            $user->password = bcrypt($request->password);
        
        $user->save();
        return redirect()->route('users.show' , ['user' => $user]);
    }
}
