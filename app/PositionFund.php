<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionFund extends Model
{
    protected $table='position_fund';
    protected $primaryKey = 'position_fid';
    protected $fillable = ['position_fname'];
    public $timestamps = false;
}

?>
