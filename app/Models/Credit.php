<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = ['people_id','user_id','take','total','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function person(){
        return $this->belongsTo(Person::class, 'people_id');
    }
}
