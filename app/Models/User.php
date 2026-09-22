<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // テーブル同士の関係の紐づけ(これをやっておくことで，後々データの取得が楽になる)
    // userからみたらたくさんのtasksを持っているので，tasksとして複数形にする
    public function tasks() {
        // 意味: 「1人のユーザーは、複数のタスクを持っている」
        // できるようになること: ユーザーから「そのユーザーが持つ全タスク」を簡単に取得できます
        return $this->hasMany(Task::class);
    }
}
