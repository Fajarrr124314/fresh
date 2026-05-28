<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'header',
        'name',
        'sub',
        'oldPrice',
        'newPrice',
        'nonMemberPrice',
        'period',
        'unit',
        'isMember',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
