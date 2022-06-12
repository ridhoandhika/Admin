<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Line_in_Service extends Model
{
    protected $table = 'line_in_service';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tr1', 'tr2','tr3', 'tr4', 'tr5','tr6','tr7','yearmonth','user',
    ];
}
