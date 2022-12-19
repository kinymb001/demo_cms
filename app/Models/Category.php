<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = ['id'];

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function scopeTest($query, $name){
        return $query->where('name', $name);
    }

}
