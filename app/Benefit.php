<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table='benefit';
    protected $primaryKey = 'benefit_id';
    protected $fillable =
    [
        'mem_id',
        'benefit_date',
        'type_bid',
        'benefit_price',
        'benefit_annotation'

    ];
    public $timestamps = false;
}
