<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CredtiDetail extends Model
{
    use SoftDeletes;
    public $timestamps = false;    
    protected $fillable = ['credit_id', 'product_id', 'pices', 'cost', 'sub_total'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
