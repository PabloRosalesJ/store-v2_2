<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['people_id','user_id','serie','total','status'];

    public function details(){
        return $this->hasMany(SaleDetails::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];
}
