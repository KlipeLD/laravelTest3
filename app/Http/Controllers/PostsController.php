<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\ArticlesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostsController extends Controller
{
    public function show($post)
    {
        $post1 = Articles::leftjoin('articles_categories','articles.category','=','articles_categories.id')
            ->leftjoin('articles_status','articles.status','=','articles_status.id')
            ->select('articles.*' ,  'articles_categories.name as art_cat', 'articles_status.name as art_status')
            ->where('articles.id', $post)
            ->orWhere('articles.slug', $post)
            ->first();

        $post11 = Articles::where('id', $post)
            ->orWhere('slug', $post)
            ->firstOrFail();

        $postId = $post1->id;

        $articles = \App\Models\Comments::latest()
            ->where('articles_id', $postId)
            ->where('moderation','1')
            ->orderBy('created_at')
            ->simplePaginate(200);

        $post2 = Articles::findOrFail($postId);
        event('postHasViewed', $post2);


        return view('articles.show',[
            'article' =>$post1,
            'article2' =>$post11,
            'comments' =>$articles
        ]);
    }

    public function index()
    {
        if(request('tag'))
        {
            if(request('category'))
            {
                // можно дополнить
                $articles = \App\Models\Tags::where('name', request('tag'))->firstOrFail()->articles;
            }
            else
            {
                $articles = \App\Models\Tags::where('name', request('tag'))->firstOrFail()->articles;
            }
        }
        else
        {
            if(request('category'))
            {
               /* $articles = \App\Models\Articles::latest()
                    ->where('articles_id', request('tag'))
                    ->orderBy('created_at')
                    ->simplePaginate(6);*/
                $articles = Articles::leftjoin('articles_categories','articles.category','=','articles_categories.id')
                    ->select('articles.*' ,  'articles_categories.name as art_cat')
                    ->where('articles_categories.name', request('category'))
                    ->simplePaginate(6);
            }
            else
            {
                $articles = \App\Models\Articles::latest()
                    ->orderBy('created_at')
                    ->simplePaginate(6);
                // $articles = \App\Models\Articles::latest()->get()->paginate(6);
            }
        }
        if(request('user'))
        {
            $articles = Articles::leftjoin('users','articles.user_id','=','users.id')
                ->select('articles.*' ,  'users.name as user_name')
                ->where('users.name', request('user'))
                ->simplePaginate(6);
        }
        else
        {
            $articles = \App\Models\Articles::latest()
                ->orderBy('created_at')
                ->simplePaginate(6);
        }
        if(request('search1'))
        {
            $articles = Articles::where('body','like','%'.request('search1').'%')
                ->orWhere('title','like','%'.request('search1').'%')
                ->orWhere('short_body','like','%'.request('search1').'%')
                ->simplePaginate(6);
           // $articles = DB::select("select * from articles where body like '%".request('search1')."%'");
        }
        else
        {
            $articles = \App\Models\Articles::latest()
                ->where('status','1')
                ->orderBy('created_at')
                ->simplePaginate(6);
        }
        return view('articles.index',['articles' =>$articles]);
    }

    public function indexAdmin()
    {
        /*$articles = \App\Models\Articles::latest()
            ->orderBy('created_at')
            ->simplePaginate(6);*/
        $articles = Articles::leftjoin('articles_categories','articles.category','=','articles_categories.id')
            ->leftjoin('articles_status','articles.status','=','articles_status.id')
            ->select('articles.*' ,  'articles_categories.name as art_cat','articles_status.name as art_status')
            ->orderby('created_at', 'desc')
            ->simplePaginate(300);
        return view('admin.articles.index',['articles' =>$articles]);
    }

    public function indexMain()
    {
        $articles = \App\Models\Articles::latest()
            ->Limit(5)
            ->get();

        return view('welcome',['articles' =>$articles]);
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

        $category = ArticlesCategory::orderby('name')
            ->get();

        return view('articles.create',[
            'tags'=>\App\Models\Tags::all(),
            'category' => $category
        ]);
    }

    public function store()
    {
        //$slug = Str::slug($name);
        $this->validateArticles();
        $article =  new Articles(request(['title','category','short_body', 'body']));
        if (Auth::check())
        {
            $article->user_id = Auth::id();
        }
        else
        {
            $article->user_id = 0;
        }
        $article->slug = str_slug(request('title'));
        $article->save();
        $article->tags()->attach(request('tags'));
        return redirect(route('articles.index'));
    }

    public function edit(Articles $post)
    {
       /* $post1 = Articles::where('id', $post)
            ->orWhere('slug', $post)
            ->firstOrFail();*/


       // $article = Articles::findorFail($post);
        return view('articles.edit',['article' =>$post]);
    }

    public function update(Articles $post)
    {
        $post->update($this->validateArticles());

        return redirect($post->path());
    }

    public function destroy($post)
    {
        DB::delete('delete from articles where id = ?',[$post]);
        $articles = Articles::leftjoin('articles_categories','articles.category','=','articles_categories.id')
            ->leftjoin('articles_status','articles.status','=','articles_status.id')
            ->select('articles.*' ,  'articles_categories.name as art_cat','articles_status.name as art_status')
            ->orderby('created_at', 'desc')
            ->simplePaginate(300);
        return view('admin.articles.index',['articles' =>$articles]);
    }
    public function novis($post)
    {
        DB::update('update articles set status = 0 where id = ?',[$post]);
        $articles = Articles::leftjoin('articles_categories','articles.category','=','articles_categories.id')
            ->leftjoin('articles_status','articles.status','=','articles_status.id')
            ->select('articles.*' ,  'articles_categories.name as art_cat','articles_status.name as art_status')
            ->orderby('created_at', 'desc')
            ->simplePaginate(300);
        return view('admin.articles.index',['articles' =>$articles]);
    }

    protected function validateArticles()
    {
        request()->validate([
            'title'=> ['required','min:3','max:255'],
            'short_body' => ['required'],
            'body' => ['required']
        ]);
    }

}
