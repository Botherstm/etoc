<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugasjawab extends Model
{
    use HasFactory;
    protected $guarded=['id'];
     public function materi()
    {
        return $this->belongsTo(Materi::class,'materi_id')->withDefault();
    }
    public function author()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    
    }
}
