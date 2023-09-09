<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExtend extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'view_nums', 'fans_nums', 'follow_nums', 'admin_role'];
}
