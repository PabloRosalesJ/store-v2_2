<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CredtiDetail extends Model
{
    protected $fillable = ['credit_id', 'product_id', 'pices', 'cost', 'sub_total'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
