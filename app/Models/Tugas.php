<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $guarded=['id'];
     public function materi()
    {
        return $this->belongsTo(Materi::class,'materi_id')->withDefault();
    }
     public function author()
    {
        return $this->belongsTo(Materi::class,'materi_id')->withDefault();
    }
}
