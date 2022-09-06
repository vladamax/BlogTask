<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatedPost extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'description' , 'text' , 'author_id'];

    public function author () {
        return $this->belongsTo(User::class);
    }
}
