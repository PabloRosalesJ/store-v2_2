<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    // public $timestamps = false;

    protected $fillable = [
        'user_id', 'username', 'password', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    /**
    *       ### Relationships
    */
    public function person()
    {
        return $this->hasOne(Person::class, 'id');
    }

    /**
    *      ### Accessors & Mutators
    *
    *  Define la forma de gradar y recuperar
    *  los datos
    *  @param mixed $value
    *  @return void
    */

    #password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    #username
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = trim($value);
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
