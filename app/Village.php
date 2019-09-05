<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table='village';
    protected $primaryKey = 'v_id';
    protected $fillable = ['v_name'];
    public $timestamps = false;
}
