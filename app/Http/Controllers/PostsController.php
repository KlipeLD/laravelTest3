<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($post)
    {
        $post1 = Articles::where('id', $post)
            ->orWhere('slug', $post)
            ->firstOrFail();

        $articles = \App\Models\Comments::latest()
            ->where('articles_id', $post1->id)
            ->orderBy('created_at')
            ->simplePaginate(200);
        // $articles = \App\Models\Articles::latest()->get()->paginate(6);
        $postId = $post1->id;
        $post2 = Articles::findOrFail($postId);
        event('postHasViewed', $post2);

        //$article = Articles::findorFail($post);
        return view('articles.show',[
            'article' =>$post1,
            'comments' =>$articles
        ]);
    }

    public function index()
    {
        if(request('tag'))
        {
            $articles = \App\Models\Tags::where('name', request('tag'))->firstOrFail()->articles;
        }
        else
        {
            $articles = \App\Models\Articles::latest()
                ->orderBy('created_at')
                ->simplePaginate(6);
            // $articles = \App\Models\Articles::latest()->get()->paginate(6);
        }
        return view('articles.index',['articles' =>$articles]);
    }

    public function indexMain()
    {
        $articles = \App\Models\Articles::latest()
            ->Limit(5)
            ->get();

        return view('welcome',['articles' =>$articles]);
        // return dd($articles);
    }

    public function clickLikes()
    {
        $slug  = $_GET['text'];
        $pieces = explode("/", $slug);
        $post = Articles::where('id', $pieces[2])
            ->orWhere('slug',$pieces[2])
            ->firstOrFail();
        $post->increment('likes'); // Increment the value in the clicks column.
        $post->update(); // Save our updated post.
        return $post->likes;
    }

    public function numbLikes()
    {
        $slug  = $_GET['text'];
        $pieces = explode("/", $slug);
        $post = Articles::where('id', $pieces[2])
            ->orWhere('slug',$pieces[2])
            ->firstOrFail();
        return $post->likes;
    }
    public function numbViews()
    {
        $slug  = $_GET['text'];
        $pieces = explode("/", $slug);
        $post = Articles::where('id', $pieces[2])
            ->orWhere('slug',$pieces[2])
            ->firstOrFail();
        return $post->views;
    }
    public function create()
    {
        $tags = \App\Models\Tags::all();

        return view('articles.create',['tags'=>\App\Models\Tags::all()]);
    }

    public function store()
    {
        //$slug = Str::slug($name);
        $this->validateArticles();
        $article =  new Articles(request(['title', 'short_body', 'body']));
        $article->user_id = 1;
        $article->slug = str_slug(request('title'));
        $article->save();
        $article->tags()->attach(request('tags'));
        return redirect(route('articles.index'));
    }

    public function edit(Articles $post)
    {
        //$article = Articles::findorFail($articleId);
        return view('articles.edit',['article' =>$post]);
    }

    public function update(Articles $post)
    {
        $post->update($this->validateArticles());

        return redirect($post->path());
    }

    public function destroy()
    {
        $articles = Articles::latest()->get();
        return view('articles.index',['articles' =>$articles]);
    }

    protected function validateArticles()
    {
        request()->validate([
            'title'=> ['required','min:3','max:255'],
            'short_body' => ['required'],
            'body' => ['required'],
            'tags' => 'exists:tags,id'
        ]);
    }
}
