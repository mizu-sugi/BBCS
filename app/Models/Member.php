<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Authenticatable クラスを使用する
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable // Authenticatable インターフェースを実装
{
    use HasFactory, Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'subtype',
        'stage',
        'current_treatment',
        'introduction'
    ];

    public function healthRecords()
    {
    return $this->hasMany(HealthRecord::class);
    }
}
