<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataChannel extends Model
{

    protected $table = 'data_channel';
    public $timestamps = true;

    protected $fillable = [
         'channel','value','yearmonth','user',
    ];
}
