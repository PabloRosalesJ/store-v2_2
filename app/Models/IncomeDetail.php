<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
    protected $fillable = ['income_id','product_id','quantity','price'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
