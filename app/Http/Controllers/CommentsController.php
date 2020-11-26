<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {

        $articles = \App\Models\Comments::latest()
            ->orderBy('created_at')
            ->get();
        return view('articles.index',['articles' =>$articles]);
    }
    public function store($post)
    {
        try
        {
            $this->validateComments();
            $post1 = Articles::where('id', $post)
                ->orWhere('slug', $post)
                ->firstOrFail();

            $postId = $post1->id;
            $comment =  new Comments(request(['subject', 'body']));
            sleep(10);
            $comment->articles_id = $postId;
            $comment->save();
        }
        catch (ModelNotFoundException $exception)
        {
            return store($post);
        }
        return redirect(route('articles.show',['post' => $post]));
    }

    public function addComment(Request $request)
    {
        /*
        try
        {
            $this->validateComments();

            $slug  = "/articles/qui-suscipit-rem-qui-aliquid-odio";
            $pieces = explode("/", $slug);
            $post = Articles::where('id', $pieces[2])
                ->orWhere('slug',$pieces[2])
                ->firstOrFail();
            $postId = $post->id;
            //$comment =  new Comments(request(['subject', 'body']));
            $comment =  new Comments($_POST[subject], $_POST[body]);
            //sleep(10);
            $comment->articles_id = $postId;
            $comment->save();
        }
        catch (ModelNotFoundException $exception)
        {
            return store($post);
        }

        $slug  = $_GET['text'];
        $pieces = explode("/", $slug);
        $post = Articles::where('id', $pieces[2])
            ->orWhere('slug',$pieces[2])
            ->firstOrFail();
        $comment = store($post->id);
        if ($comment)
        {
            return "Ваш комментарий успешно добавлен";
        }*/
        dd($request->all());
    }

    protected function validateComments()
    {
        request()->validate([
            'subject'=> ['required'],
            'body' => ['required']
        ]);
    }
}
