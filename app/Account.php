<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table='account';
    protected $primaryKey = 'acc_id';
    protected $fillable =
    [
        'acc_name',
        'acc_date',
        'group_acid',
        'acc_piece',
        'acc_price',
        'acc_total',
        'acc_file'
    ];
    public $timestamps = false;
}
