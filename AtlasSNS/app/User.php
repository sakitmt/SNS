<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() { //1対多の「多」側なので複数形
        return $this->hasMany('App\Posts');
    }

    public function follows() { //多対多
       return $this->belongsToMany(User::class, 'follows', 'id', 'following_id', 'followed_id');
   }

   public function followers() { //多対多
       return $this->belongsToMany(User::class, 'follows', 'id', 'following_id', 'followed_id');
   }
}