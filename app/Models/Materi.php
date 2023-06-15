<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['tille'];
    public function materi()
    {
        return $this->hasMany(Post::class);
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function tugasjawab()
    {
        return $this->hasMany(Tugas::class);
    }
}
