<?php

namespace App\Http\Controllers;

use App\Models\ArticlesCategory;
use Illuminate\Http\Request;
use DB;

class CategoresController extends Controller
{
    public function indexAdmin()
    {
        $category = \App\Models\ArticlesCategory::leftjoin('articles','articles_categories.id','=','articles.category')
            ->selectRaw('articles_categories.name, count(articles.category) as art_count, articles_categories.id as id')
            ->groupby('articles_categories.name','articles_categories.id')
            ->get();
        return view('admin.categories.index',['categories' =>$category]);
    }
    public function edit(ArticlesCategory $category)
    {
        /* $post1 = Articles::where('id', $post)
             ->orWhere('slug', $post)
             ->firstOrFail();*/


        // $article = Articles::findorFail($post);
        return view('admin.categories.edit',['category' =>$category]);
    }
    public function update(ArticlesCategory $category)
    {
        $category->update($this->validateCategories());

        return redirect($category->path());
    }
    protected function validateCategories()
    {
        request()->validate([
            'name'=> ['required','min:1','max:255'],

        ]);
    }
    public function destroy($category)
    {
        DB::delete('delete from articles_categories where id = ?',[$category]);
        $categories = \App\Models\ArticlesCategory::leftjoin('articles','articles_categories.id','=','articles.category')
            ->selectRaw('articles_categories.name, count(articles.category) as art_count, articles_categories.id as id')
            ->groupby('articles_categories.name','articles_categories.id')
            ->get();
        return view('admin.categories.index',['categories' =>$categories]);
    }
}
