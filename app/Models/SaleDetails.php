<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $table = 'sales_details';
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'discount'];
}
