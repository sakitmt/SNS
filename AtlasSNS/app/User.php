<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\Model;

class YourModel extends Model
{
    protected $table = 'follows';
}

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

    public function followers() { //フォローされているとき
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
        // '関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名'
    }

    public function follows() {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    public function isFollowing($user_id) {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);
    }

    public function isFollowed($user_id) {
        return (boolean) $this->follows()->where('following_id', $user_id)->first(['follows.id']);
    }
}