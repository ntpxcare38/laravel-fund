<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $guard = 'member';

    protected $table='members';
    protected $primaryKey = 'mem_id';
    protected $fillable =
    [
        'mem_no',
        'mem_card_id',
        'mem_title',
        'mem_fname',
        'mem_lname',
        'mem_birthdate',
        'mem_add_no',
        'v_id',
        'register_date',
        'resign_date',
        'mem_status',
        'mem_cause_st',
        'password',
        'type_mid'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password'
    ];




}
