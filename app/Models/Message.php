<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', // 追加
        'content', // 追加
        'member_id', // 追加
    ];

    public function member()
{
    return $this->belongsTo(Member::class, 'member_id');
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

}
