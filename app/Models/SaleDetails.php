<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class SaleDetails extends Model
{
    protected $table = 'sales_details';
    public $timestamps = false;
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'discount'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    //Casting
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
