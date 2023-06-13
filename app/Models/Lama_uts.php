<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lama_uts extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable=['jam','menit'];
}
