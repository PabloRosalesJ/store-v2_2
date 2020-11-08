<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use SoftDeletes;

    protected $fillable = ['people_id','user_id','take','total','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function person(){
        return $this->belongsTo(Person::class, 'people_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
