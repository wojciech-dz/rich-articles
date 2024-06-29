<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $articles = DB::table('articles')->orderBy('id')->paginate(3);
        $actionIcons = [
            "icon:pencil | click:redirect('/article/{id}')",
            "icon:trash | color:red | click:deleteArticle({id}, '{title}}')",
        ];

        return view('dashboard', ['articles' => $articles, 'action_icons'=>$actionIcons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
//            'title' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:2000'],
        ]);
        Article::create([
            'title' => $request->title,
            'contents' => $request->content,
            'author_id' => $request->user()->id,
        ]);

//        Session::flash('success', 'Article created successfully!');

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
