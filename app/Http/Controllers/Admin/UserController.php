<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
class UserController extends Controller
{
    public function index( Request $request)
    {
        $users = User::whereNameFilter($request->name)
            ->wherePeriod($request->period)
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('admin/users/index', compact('users'));
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
