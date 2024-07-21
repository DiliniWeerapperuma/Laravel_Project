<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'nic',
        'address',
        'mobile',
        'email',
        'gender',
        'torritory',
        'username',
        'password',
        'type'
    ];

   protected $hidden =[
     'password',
     'remember_token'
   ];

   protected $casts = [
    'email_verified_at' => 'datetime' ,
    'password' => 'hashed',

   ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin"][$value],
        );
    }
}

