<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datatrafik extends Model
{
    protected $table = 'data_trafik';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sosmed_komplain', 'plasa_komplain','komplain_147', 'myih_komplain','yearmonth','user',
    ];
}