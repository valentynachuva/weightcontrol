<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = [
        'value',
        'remark',
        'user_id'
        
    ];
}
