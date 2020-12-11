<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Provider;

class Product extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    protected $fillable = [
            'category_id', 'provider_id', 'bar_code', 'name', 'description', 'image', 
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

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'status' => 'boolean',
    ];
}
