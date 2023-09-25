<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    public $timestamps = true;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function setRememberTokenAttribute($value)
    {
        $this->attributes['remember_token'] = \Hash::make($value);
    }

    public function twits(){
        return $this->hasMany(Twit::class);
    }

}
