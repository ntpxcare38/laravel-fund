<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Personnel extends Authenticatable
{
    protected $guard = 'personnel';

    protected $table='personnels';
    protected $primaryKey = 'p_id';
    protected $fillable =
    [
        'p_title',
        'p_fname',
        'p_lname',
        'p_photo',
        'position_fid',
        'position_cid',
        'p_tel',
        'type_pid',
        'p_username',
        'password'

    ];
    public $timestamps = false;

    protected $hidden = [
        'password'
    ];

}
