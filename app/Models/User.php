<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasRoles;

    protected $fillable = ['account', 'phone', 'email', 'password', 'nickname', 'avatar', 'gender', 'signature', 'email_verified_at'];

    protected $hidden = ['password','remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function userExtend()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
