<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['user_id','number','total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function income_details(){
        return $this->hasOne(IncomeDetail::class);
    }

    // public function product()
    // {
    //     return $this->hasOneThrough(Product::class, IncomeDetail::class,'product_id','id');
    // }
    public function products()
    {
        return $this->hasManyThrough(Product::class, IncomeDetail::class);
    }
}