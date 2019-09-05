<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BenefitType extends Model
{
    protected $table='benefit_type';
    protected $primaryKey = 'type_bid';
    protected $fillable = ['type_bname'];
    public $timestamps = false;
}
