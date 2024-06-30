<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $articles = DB::table('articles')
            ->where('author_id', '=', Auth::id())
            ->orderBy('title')
            ->paginate(3);
        $actionIcons = [
            "icon:trash | color:red | click:deleteArticle({id}, '{title}')",
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
            'title' => 'required|string|max:255|unique:App\Models\Article,title',
            'meat' => 'required|string|max:2000',
        ]);
        Article::create([
            'title' => $request->title,
            'contents' => $request->meat,
            'author_id' => $request->user()->id,
        ]);

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

    public function deleteArticle(Request $request): JsonResponse
    {
        $id = $request->all()['params']['id'];
        $userId = Auth::id();
        if ($article = Article::findOrFail($id)) {
            if ($article->author_id === $userId || Auth::user()->isAdmin()) {
                dd('bede kasować');
                $article->delete();
            }
        }

        return Response::json ([
            'success' => true,
            'info' => 'Article successfully deleted',
        ]);
    }
}
