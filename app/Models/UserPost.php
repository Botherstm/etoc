<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;
    protected $table = 'user_post';

    protected $fillable = [
        'user_id', 'post_id', 'accessed_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
