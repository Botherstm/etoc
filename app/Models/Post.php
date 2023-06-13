<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    protected $guarded = ['id'];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
     public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id')->withDefault();
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')->orWhere('isi', 'like', '%' . $search . '%');
        });

        $query->when($filters['author'] ?? false, fn($query, $author) => $query->whereHas('author', fn($query) => $query->where('username', $author)));
    }
    public function sluggable(): array
    {
        return [
            'id' => [
                'source' => 'id'
            ]
        ];
    }
}
