<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmarks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'author', 'title', 'description', 'url', 'urlToImage'];
    // Relationship to user
    public function user() {
        return $this->belongsTo(User::class. 'user_id');
    }
}
