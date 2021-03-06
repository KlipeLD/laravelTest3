<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesStatus extends Model
{
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
}
