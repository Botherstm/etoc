<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $fillable = ['uts_completed_at','name','email','password','username','gambar','acc'];
    // protected $fillable = [
    // // kolom lainnya
    // 'uts_complete_at',
    // ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function uts()
    {
        return $this->hasMany(Uts::class);
    }
        public function utsjawab()
    {
        return $this->hasMany(Utsjawab::class);
    }
         public function start_uts()
    {
        return $this->hasMany(Start_uts::class);
    }

         public function uasjawab()
    {
        return $this->hasMany(Uasjawab::class);
    }
         public function start_uas()
    {
        return $this->hasMany(Start_uas::class);
    }
    
    public function author()
    {
        return $this->hasMany(Tugasjawab::class);
    }
}
