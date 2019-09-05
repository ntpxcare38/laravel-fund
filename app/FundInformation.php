<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundInformation extends Model
{
    protected $table='fund_information';
    protected $primaryKey = 'fund_id';
    protected $fillable =
    [
        'fund_name',
        'fund_no',
        'fund_village',
        'fund_moo',
        'fund_soi',
        'fund_road',
        'fund_tumbol',
        'fund_district',
        'fund_province',
        'fund_zipcode',
        'fund_tel',
        'fund_tel_m',
        'fund_fax',
        'fund_email',
        'fund_web',
        'fund_name_h',
        'fund_name_c',
        'fund_habitant',
        'fund_edit_by',
        'fund_edit_time',

    ];
    public $timestamps = false;
}
