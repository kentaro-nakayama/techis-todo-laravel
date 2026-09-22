<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // テーブル同士の関係の紐づけ
    // Tasksから見たら一人のuserに紐づくので，userで単数形
    public function user() {
        // 意味: 1つのTaskは、1人のUserに所属している(従属)
        // $this = Taskオブジェクト
        // できるようになること: タスクから「そのタスクの所有者」を簡単に取得できるようになる．
        return $this->belongsTo(User::class);
    }
}
