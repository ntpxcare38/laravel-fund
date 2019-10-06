@extends('main')
@section('title','แก้ไขข้อมูลกองทุน')
@section('content')
<?php

    $day = date("d");
    $month = date("m");
    $year = date("Y")+543;
    $dateObj = ("$year-$month-$day");

    date_default_timezone_set('Asia/Bangkok');
    $now = date("Y-m-d H:i:s");

    function DateThai($now)
    {
        $strYear = date("Y",strtotime($now))+543;
        $strMonth= date("n",strtotime($now));
        $strDay= date("j",strtotime($now));
        $strHour= date("H",strtotime($now));
        $strMinute= date("i",strtotime($now));
        $strSeconds= date("s",strtotime($now));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "วันที่ "."$strDay $strMonthThai $strYear"." เวลา "."$strHour:$strMinute:$strSeconds"." น.";

    }
?>
<div class="container content-fund">
        <div class="cre-fund">
                <div class="row">
                    <form action="{{ route('fund.update', $fund->fund_id) }}" method="post" id="formFund" onsubmit="return chkFrmFundEdit();">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="input-field col s11 m8">
                                <i class="material-icons prefix">account_balance</i>
                                <input name="fund_name" type="text" maxlength="60" onkeyup="javascript:controlchars(this,alphaNumber)" class="validate" value="{{$fund->fund_name}}" required>
                                <label>ชื่อกองทุน</label>
                            </div>
                            <div class="input-field col s6 m2">
                                <i class="material-icons prefix">confirmation_number</i>
                                <input name="fund_no" type="text" maxlength="7" onkeyup="javascript:controlchars(this,homenumber)" class="validate" value="{{$fund->fund_no}}" required>
                                <label>เลขที่ตั้ง</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m3">
                                <i class="material-icons prefix">home</i>
                                <input name="fund_village" type="text" maxlength="40" onkeyup="javascript:controlchars(this,alphaNumber)" class="validate" value="{{$fund->fund_village}}" required>
                                <label>หมู่บ้าน</label>
                            </div>
                            <div class="input-field col s2 m1">
                                <input name="fund_moo" type="text" maxlength="2" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_moo}}" required>
                                <label>หมู่</label>
                            </div>
                            <div class="input-field col s2 m1">
                                <input name="fund_soi" type="text" maxlength="2" onkeyup="javascript:controlchars(this,numberNot)" class="validate" value="{{$fund->fund_soi}}" required>
                                <label>ซอย</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <input name="fund_road" type="text" maxlength="40" class="validate" value="{{$fund->fund_road}}" required>
                                <label>ถนน</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <input name="fund_tumbol" type="text" maxlength="30" class="validate" value="{{$fund->fund_tumbol}}" required>
                                <label>ตำบล</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <i class="material-icons prefix">poll</i>
                                <input name="fund_district" type="text" maxlength="30" onkeyup="javascript:controlchars(this,alpha)" class="validate" value="{{$fund->fund_district}}" required>
                                <label>อำเภอ</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <input name="fund_province" type="text" maxlength="30" onkeyup="javascript:controlchars(this,alpha)" class="validate" value="{{$fund->fund_province}}" required>
                                <label>จังหวัด</label>
                            </div>
                            <div class="input-field col s8 m2">
                                    <input name="fund_zipcode" type="text" maxlength="6" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_zipcode}}" required>
                                    <label>รหัสไปรษณีย์</label>
                            </div>
                            <div class="input-field col s7 m3">
                                <i class="material-icons prefix">supervisor_account</i>
                                <input name="fund_habitant" type="text" maxlength="8" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_habitant}}" required>
                                <label>จำนวนประชากรในตำบล</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 m3">
                                <i class="material-icons prefix">phone</i>
                                <input name="fund_tel" type="text" maxlength="9" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_tel}}" required>
                                <label>เบอร์โทรศัพท์</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <i class="material-icons prefix">phone_iphone</i>
                                <input name="fund_tel_m" type="text" maxlength="10" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_tel_m}}" required>
                                <label>เบอร์โทรศัพท์มือถือ</label>
                            </div>
                            <div class="input-field col s8 m3">
                                <i class="material-icons prefix">receipt</i>
                                <input name="fund_fax" type="text" maxlength="9" onkeyup="javascript:controlchars(this,number)" class="validate" value="{{$fund->fund_fax}}" required>
                                <label>โทรสาร</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 m4">
                                <i class="material-icons prefix">contact_mail</i>
                                <input name="fund_email" type="email" maxlength="40" onkeyup="javascript:controlchars(this,alphaemail)" class="validate" value="{{$fund->fund_email}}" required>
                                <label>E-mail</label>
                            </div>
                            <div class="input-field col s8 m5">
                                <i class="material-icons prefix">web</i>
                                <input name="fund_web" type="text" maxlength="40" onkeyup="javascript:controlchars(this,alphaWeb)" class="validate" value="{{$fund->fund_web}}" required>
                                <label>เว็บไซต์</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 m4">
                                <i class="material-icons prefix">person</i>
                                <input name="fund_name_h" type="text" maxlength="50" onkeyup="javascript:controlchars(this,alpha)" class="validate" value="{{$fund->fund_name_h}}" required>
                                <label>ชื่อประธานกองทุน</label>
                            </div>
                            <div class="input-field col s8 m4">
                                <i class="material-icons prefix">person</i>
                                <input name="fund_name_c" type="text" maxlength="50" onkeyup="javascript:controlchars(this,alpha)" class="validate" value="{{$fund->fund_name_c}}" required>
                                <label>ชื่อผู้ประสานงาน</label>
                            </div>
                        </div>
                        <input name="p_id" type="hidden" class="validate" value="{{Auth::user()->p_id}}">
                        <input name="fund_edit_time" type="hidden" class="validate" value="{{$now}}">



                                <div class="center-align">
                                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action">แก้ไขข้อมูล</button>
                                        <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light btn-black" type="button" name="action">ยกเลิก</button></a>
                                    </div>
                    </form>
            </div>
            <div class="col s11 m5 right-align">
                <label id="mem_name" >แก้ไขล่าสุดเมื่อ : {{ DateThai($fund->fund_edit_time) }} โดย : {{$fund->p_fname}} {{$fund->p_lname}}</label>
            </div>
    </div>
</div>
<script>
    function chkFrmFundEdit() {

        Swal.fire({
            title: 'ยืนยันการแก้ไข',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              document.getElementById("formFund").submit();
            }
          })
          return false;
  }
</script>
@endsection
