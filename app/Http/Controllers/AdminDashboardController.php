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
        $usersIcons = [
            "icon:chat | tip:send message | color:green | click:sendMessage('{email}')",
            "icon:pencil | click:toggleAdmin({id}, '{name}')",
            "icon:trash | color:red | click:deleteUser({id}, '{name}')",
        ];
        $articlesIcons = [
            "icon:trash | color:red | click:deleteArticle({id}, '{title}')",
        ];
        $articles = DB::table('articles')->orderBy('title')->paginate(5);

        return view('admin.admindashboard', [
            'users' => $users,
            'articles' =>$articles,
            'users_icons'=>$usersIcons,
            'articles_icons'=>$articlesIcons,
        ]);
    }
}
