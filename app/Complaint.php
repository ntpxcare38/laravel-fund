<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table='complaint';
    protected $primaryKey = 'comp_id';
    protected $fillable =
    [
        'mem_id',
        'comp_date',
        'comp_title',
        'comp_detail'

    ];
    public $timestamps = false;
}

