<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $fillable = [
        'name', 'address', 'user_id', 'business_id'
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
