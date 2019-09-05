<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionCom extends Model
{
    protected $table='position_com';
    protected $primaryKey = 'position_cid';
    protected $fillable = ['position_cname'];
    public $timestamps = false;
}
