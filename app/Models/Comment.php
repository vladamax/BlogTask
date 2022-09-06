<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_author_id' , 'text' , 'post_id'];

    public function Author () {
        return $this->belongsTo(User::class,'comment_author_id');
    }
}
