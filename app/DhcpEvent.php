<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpEvent extends Model
{
    protected $fillable = ['message','active'];

    /**
     * @var array
     */
    protected $casts = [
        'message' => 'array'
    ];
}
