<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        // if there're three articles created by the userId 1

        /**
         * $articles = Article::orderBy('id', 'desc')->paginate(10);
         *
         * If three articles are created by the userId 1,
         * two articles are created by the userId 2
         *
         * Database SQL logging: (6 SQL is executed)
         * select * from "articles" where "articles"."deleted_at" is null order by "id" desc limit 10 offset 0
         * select * from 'users' where 'users'.'id' = '1' limit 1
         * select * from 'users' where 'users'.'id' = '1' limit 1
         * select * from 'users' where 'users'.'id' = '1' limit 1
         * select * from 'users' where 'users'.'id' = '2' limit 1
         * select * from 'users' where 'users'.'id' = '2' limit 1
         *
         */

        // solve N+1 problem
        /**
         * $articles = Article::with('user')->orderBy('id', 'desc')->paginate(10);
         *
         * Solve N+1 problem, put N+1 problem to 1+1
         *
         * Database SQL logging: (2 SQL is executed)
         * select * from "articles" where "articles"."deleted_at" is null order by "id" desc limit 10 offset 0
         * select * from 'users' where 'users'.'id' in (1, 2)
         */
        $articles = Article::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('articles.index', ['articles' => $articles]);
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {

        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

        auth()->user()->articles()->create($content);

        return redirect()->route('root')->with('notice', 'The article has been created successfully!');

    }

    public function edit($id) {
        $article = auth()->user()->articles->find($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id) {
        $article = auth()->user()->articles->find($id);

        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

        $article->update($content);

        return redirect()->route('root')->with('notice', 'The article has been updated successfully!');
    }

    public function show($id) {
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function destroy($id) {
        $article = auth()->user()->articles->find($id);
        $article->delete();

        return redirect()->route('root')->with('notice', 'The article has been deleted successfully!');
    }

}
