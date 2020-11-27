<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesCategory extends Model
{
    use HasFactory;
    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
    public function path()
    {
        return route('admin.categories.index',$this);
    }
}
