<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $users = DB::table('users')->orderBy('name')->paginate(2);
        $actionIcons = [
            "icon:chat | tip:send message | color:green | click:sendMessage('{name}')",
            "icon:pencil | click:redirect('/profile/{id}')",
            "icon:trash | color:red | click:deleteUser({id}, '{name}')",
        ];

        return view('admin.admindashboard', ['users' => $users, 'action_icons'=>$actionIcons]);
    }
}
