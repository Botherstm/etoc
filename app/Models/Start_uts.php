<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start_uts extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['end_time','user_id'];

        public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

}
