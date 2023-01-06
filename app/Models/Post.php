<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'thumb',
        'category_id',
        'tag_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
