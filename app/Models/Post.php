<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug' , 'description'];


    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = str_replace(' ', '-', $post->title);
        });
    }
}
