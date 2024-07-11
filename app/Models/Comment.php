<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function member()
{
    return $this->belongsTo(Member::class);
}

public function message()
{
    return $this->belongsTo(Message::class);
}
}
