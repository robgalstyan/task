<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected  $fillable = [
        'review_id',
        'parent_id',
        'user_id',
        'text'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
