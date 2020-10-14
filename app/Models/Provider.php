<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;

    protected $primaryKey = 'provider_id';
    protected $fillable = ['provider_id','provider_name'];

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
    
    #provider_name
    public function setProviderNameAttribute($value)
    {
        $this->attributes['provider_name'] = trim(strtolower($value));
    }
    public function getProviderNameAttribute($value)
    {
        return ucwords($value);
    }

}
