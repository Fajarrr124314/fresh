<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username', 
        'email',
        'password',
        'role',     
    ];

    // WAJIB: Beritahu Laravel login pake kolom username
    public function username()
    {
        return 'username';
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function labels()
    {
        return $this->hasMany(Label::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}