<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    // protected $primaryKey = 'user_id';
    // public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'username', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
