<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $table = 'sales_details';
    public $timestamps = false;
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'discount'];

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
