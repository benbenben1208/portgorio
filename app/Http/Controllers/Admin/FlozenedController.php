<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class FlozenedController extends Controller
{
    public function index()
    {
        $users =User::onlyTrashed()->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('admin.flozened.index', compact('users'));    
    }
    public function restore(int $flozened_id)
    {
        
        User::onlyTrashed()->where('id', $flozened_id)->restore();
       

        return redirect()->route('admin.flozened.index');
    }

}
