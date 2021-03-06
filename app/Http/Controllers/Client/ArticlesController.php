<?php

namespace App\Http\Controllers\Client;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Comment;

/**
 * Class ArticlesController - controller for articles on the client side.
 */
class ArticlesController extends ClientBase
{
    /**
     * Method for getting a list of articles.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
	{
        if(isset($request->page)) {
            Cache::tags(['articles', 'list'])
                ->flush();
        }

	    $articles = Cache::tags(['articles', 'list'])
            ->remember('public', env('CACHE_TIME', 0), function () {
            return Article::with('user')
                ->latest()
                ->paginate(5);
        });

		$this->menu = Menu::setMenuIsActive($this->menu, 'index');
		
		return view('layouts.double', [
			'articles' => $articles,
            'title' => 'Articles List',
            'page' => 'pages.client.articlesList',
			'recent_posts' => $this->recent_posts,
			'menu' => $this->menu,
		]);
	}

    /**
     * Method for getting an article page.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function one($id)
	{
	    $article = Article::findOrFail($id);
	    $comments = Comment::where('article_id', $id)
            ->where('parent_id', null)
            ->get();
        $authStatus = Auth::check();

		return view('layouts.double', [
			'page' => 'pages.client.articlePage',
			'title' => 'Article ' . $article->title, 
			'article' => $article,
			'recent_posts' => $this->recent_posts,
			'menu' => $this->menu,
			'comments' => view('pages.client.commentsWrapper', [
			    'authStatus' => $authStatus,
			    'comments' => $comments,
                'article' => $article,
            ]),
		]);
	}
}
