<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['kunci','soal','a','b','c','d','gambar','user_id'];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function utsjawabsoal()
    {
        return $this->hasMany(Uasjawab::class);
    }
    
    public function scopeFiltersoaluts($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('soal', 'like', '%' . $search . '%')->orWhere('a','b','c','c','d', '%' . $search . '%');
        });
        $query->when($filters['author'] ?? false, fn($query, $author) => $query->whereHas('author', fn($query) => $query->where('username', $author)));
    }
}
