<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PercentTraffic extends Model
{
    protected $table = 'percent_traffic';
    public $timestamps = true;
    protected $primaryKey = 'yearmonth';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tr1', 'tr2','tr3', 'tr4', 'tr5','tr6','tr7','yearmonth','user',
    ];
}
