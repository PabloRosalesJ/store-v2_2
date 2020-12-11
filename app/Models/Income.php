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
        return $this->hasMany(IncomeDetail::class);
    }
    
    public function products()
    {
        return $this->hasManyThrough(Product::class, IncomeDetail::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];
}