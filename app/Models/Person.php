<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'name', 'l_name', 's_name', 'address', 'phone', 'email', 'status', 'can_buy_credit'
    ];

    /**
    *      ### Accessors & Mutators 
    * 
    *  Define la forma de gradar y recuperar 
    *  los datos
    *  @param mixed $value
    *  @return void
    */

    #name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(strtolower($value));
    }
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    #l_name
    public function setLNameAttribute($value)
    {
        $this->attributes['l_name'] = trim(strtolower($value));
    }
    public function getLNameAttribute($value)
    {
        return ucfirst($value);
    }

    #s_name
    public function setSNameAttribute($value)
    {
        $this->attributes['s_name'] = trim(strtolower($value));
    }
    public function getSNameAttribute($value)
    {
        return ucfirst($value);
    }

    #address
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = trim(strtolower($value));
    }
    public function getAddressAttribute($value)
    {
        return ucwords($value);
    }

}
