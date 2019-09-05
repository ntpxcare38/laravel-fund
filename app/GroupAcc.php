<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAcc extends Model
{
    protected $table='group_account';
    protected $primaryKey = 'group_acid';
    protected $fillable =
    [
        'group_acname',
        'type_acc'
    ];
    public $timestamps = false;
}
