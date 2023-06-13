<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uasjawab extends Model
{
    use HasFactory;
     protected $guarded = ['id'];
        protected $casts = [
        'jawaban' => 'array',
        'soal_id' => 'array',
        'kunci' => 'array',
    ];
    public function utsjawabsoal()
    {
        return $this->belongsTo(Uas::class, 'soal_id')->withDefault();
    }
        public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function scopeFilterjawabanuts($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('jawaban', 'like', '%' . $search . '%')->orWhere('a','b','c','c','d', '%' . $search . '%');
        });
        $query->when($filters['author'] ?? false, fn($query, $author) => $query->whereHas('author', fn($query) => $query->where('username', $author)));
    }
}
