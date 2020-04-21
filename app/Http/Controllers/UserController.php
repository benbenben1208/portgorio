<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function show(int $user_id)
    {
        $user = User::where('id', $user_id)->first();

        return view('users/show', compact('user'));
    }
}
