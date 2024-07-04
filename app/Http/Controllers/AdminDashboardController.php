<?php

namespace App\Http\Controllers;

use App\Mail\NoticeUser;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $users = DB::table('users')->orderBy('name')->paginate(5, ['*'], 'users');
        $usersIcons = [
            "icon:chat | tip:send message | color:green | click:sendMessage('{id}')",
            "icon:pencil | click:toggleAdmin({id}, '{name}')",
            "icon:trash | color:red | click:deleteUser({id}, '{name}')",
        ];
        $articlesIcons = [
            "icon:trash | color:red | click:deleteArticle({id}, '{title}')",
        ];
        $articles = DB::table('articles')->orderBy('title')->paginate(5, ['*'], 'articles');

        return view('admin.admindashboard', [
            'users' => $users,
            'articles' =>$articles,
            'users_icons'=>$usersIcons,
            'articles_icons'=>$articlesIcons,
        ]);
    }

    public function sendNotification(Request $request): JsonResponse
    {
        $params = request()->all()['params'];
        if ($user = User::findOrFail($params['id'])) {
            app()->setLocale($user->localization);
            if ($article = Article::where('author_id', $params['id'])->first()) {
                Mail::to($user->email)->send(new NoticeUser($user, $article));
            } else {
                Mail::to($user->email)->send(new NoticeUser($user));
            }
            app()->setLocale(Auth::user()->localization);
        }

        return Response::json ([
            'success' => true,
            'info' => 'Mail has been sent',
        ]);
    }
}
