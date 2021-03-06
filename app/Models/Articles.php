<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected  $guarded =[];

    public function path()
    {
        return route('articles.show',$this);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(ArticlesCategory::class);
    }
    public function status()
    {
        return $this->belongsTo(ArticlesStatus::class);
    }
}
