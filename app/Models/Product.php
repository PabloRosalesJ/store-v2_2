<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
            'category_id', 'bar_code', 'name', 'description', 'image', 
            'buy_price', 'unit_price', 'wholesale_price', 'stock', 'status'
    ];
    
    /**
     *      ### Accessors & Mutators 
     * 
     *  Define la forma de gradar y recuperar 
     *  los datos
     *  @param mixed $value
     *  @return void
     */
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtolower($value);
    }

    public function getDescriptionAttribute($value)
    {
        return ucfirst($value);
    }
}
