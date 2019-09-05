<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $table='member_type';
    protected $primaryKey = 'type_mid';
    protected $fillable = ['type_mname'];
    public $timestamps = false;
}
