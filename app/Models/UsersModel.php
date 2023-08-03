<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'username', 'password', 'id_level', 'profile', 'created_at'];
}
