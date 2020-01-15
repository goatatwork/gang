<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackchannelMessage extends Model
{
    protected $fillable = ['message','active'];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
    ];
}
