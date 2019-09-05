@extends('main')
@section('title','แก้ไขข้อมูลสมาชิก')
@section('content')
<?php

    $day = date("d");
    $month = date("m");
    $year = date("Y")+543;
    $dateObj = ("$year-$month-$day");

    date_default_timezone_set('Asia/Bangkok');
    $now = date("d-m-Y H:i:s");

    function DateThai($now)
    {
        $strYear = date("Y",strtotime($now));
        $strMonth= date("n",strtotime($now));
        $strDay= date("j",strtotime($now));
        return "$strYear $strMonth $strDay  ";
    }
    $date_now =  DateThai($dateObj);
?>
<div class="container content-fund">
    <div class="cre-mem">
        <div class="row">
            <form name="formMem" id="formMem" action="{{ route('mem.update', $mem->mem_id) }}" method="post" onsubmit="return chkFrmMemEdit()">
                @method('PATCH')
                @csrf
                <div class="col s12 m12">
                    <div class="input-field col s5 m3">
                        <i class="material-icons prefix">confirmation_number</i>
                    <input name="mem_no" type="text" id="icon_prefix" class="validate" value="{{$mem->mem_no}}" onkeyup="javascript:controlchars(this,homenumber)" maxlength="10" required>
                        <label for="icon_prefix">เลขที่สมาชิก</label>
                    </div>
                    <div class="input-field col s7 m3">
                        <i class="material-icons prefix">perm_identity</i>
                        <input name="mem_card_id" type="text" id="icon_prefix" class="validate" value="{{$mem->mem_card_id}}" onkeyup="javascript:controlchars(this,number)" minlength="13" maxlength="13" required >
                        <label for="icon_prefix">เลขบัตรประชาชน</label>
                    </div>
                    <div class="input-field col s7 m3">
                        <i class="material-icons prefix">date_range</i>
                        <input name="date_now" type="hidden" id="date_now" value="{{$date_now}}">
                        <input name="mem_birthdate" type="text" value="{{$mem->mem_birthdate}}" onchange="calculate()" id="date1" class="datepicker" required>
                        <label for="icon_prefix">วัน/เดือน/ปีเกิด</label>
                    </div>
                </div>

                <div class="col s12 m12">
                    <div class="input-field col s5 m2">
                        <i class="material-icons prefix">portrait</i>
                            <select name="mem_title">
                                <option value="1" @if($mem->mem_title==1) selected='selected' @endif>นาย</option>
                                <option value="2" @if($mem->mem_title==2) selected='selected' @endif>นาง</option>
                                <option value="3" @if($mem->mem_title==3) selected='selected' @endif>นางสาว</option>
                                <option value="4" @if($mem->mem_title==4) selected='selected' @endif>เด็กชาย</option>
                                <option value="5" @if($mem->mem_title==5) selected='selected' @endif>เด็กหญิง</option>
                            </select>
                    </div>
                    <div class="input-field col s6 m3">
                        <input name="mem_fname" type="text"class="validate" value="{{$mem->mem_fname}}" onkeyup="javascript:controlchars(this,alpha)" maxlength="40" required >
                        <label>ชื่อ</label>
                    </div>
                    <div class="input-field col s6 m3">
                        <input name="mem_lname" type="text"class="validate" value="{{$mem->mem_lname}}" onkeyup="javascript:controlchars(this,alpha)" maxlength="40" required >
                        <label>นามสกุล</label>
                    </div>
                    <div class="input-field col s6 m3">
                        <i class="material-icons prefix">date_range</i>
                        <input name="register_date" type="text" value="{{$mem->register_date}}" id="date2" class="datepicker" required>
                        <label for="icon_prefix">วันที่เข้าสมาชิก</label>
                    </div>
                </div>

                <div class="col s12 m12">
                    <div class="input-field col s7 m2">
                        <i class="material-icons prefix">home</i>
                        <input name="mem_add_no" type="text" id="icon_prefix" class="validate" value="{{$mem->mem_add_no}}" onkeyup="javascript:controlchars(this,homenumber)" maxlength="8" required>
                        <label for="icon_prefix">บ้านเลขที่</label>
                    </div>
                    <div class="input-field col s10 m4">
                        <select name="v_id" id="mooSelect">
                            <option value="0">เลือกหมู่ที่</option>
                                @foreach ($vils as $vil)
                                    <option value="{{$vil->v_id}}" @if($vil->v_id==$mem->v_id) selected='selected' @endif>หมู่ {{$vil->v_id}} {{$vil->v_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="input-field col s10 m3">
                        <select name="type_mid" id="mtypeSelect">
                                <option value="0">เลือกลักษณะสมาชิก</option>
                                @foreach ($mtypes as $mtype)
                                    <option value="{{$mtype->type_mid}}" @if($mtype->type_mid==$mem->type_mid) selected='selected' @endif>{{$mtype->type_mname}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="input-field col s10 m3">
                        <p id="show-age" style="color:red;"></p>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="input-field col s6 m3">
                        <input name="password" type="password" class="validate">
                        <label>Password</label>
                    </div>
                    <div class="input-field col s6 m3">
                        <input name="cpassword" type="password" class="validate">
                        <label>Confirm Password</label>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <label>
                            <input name="mem_status" class="with-gap" onclick="javascript:chkStatus()" type="radio" value="1" @if($mem->mem_status==1) checked='checked' @endif required>
                            <span>สถานะสมาชิกปกติ</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="row">
                        <div class="input-field col s6 m3">
                            <label>
                            <input name="mem_status" class="with-gap" id="chkResign" type="radio" onclick="javascript:chkStatus()" value="2" @if($mem->mem_status==2) checked='checked' @endif required>
                            <span>สถานะพ้นจากสมาชิก</span>
                            </label>
                        </div>
                        <div id="resign" style="visibility:hidden">
                            <div class="input-field col s6 m3">
                                <i class="material-icons prefix">date_range</i>
                                <input name="resign_date" type="text" value="{{$mem->resign_date}}" id="date3" class="datepicker" value="">
                                <label for="icon_prefix">วันที่พ้นจากสมาชิก</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">feedback</i>
                                <input name="mem_cause_st" type="text" id="mem_cause" class="validate" value="{{$mem->mem_cause_st}}" onkeyup="javascript:controlchars(this,alpha)" maxlength="50" value="">
                                <label for="icon_prefix">สาเหตุ</label>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="center-align">
                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >บันทึก</button>
                        <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light btn-black" type="button" name="action">ยกเลิก</button></a>
                    </div>
                </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/member.js') }}"></script>
<script>
        calculate = function () {

            var date1 = document.getElementById('date1').value
            var date2 = document.getElementById('date_now').value

            var d1 = Date.parse(date1);
            var d2 = Date.parse(date2);
            var diff_date =  d2-d1;

            var num_years = diff_date/31536000000;
            var num_months = (diff_date % 31536000000)/2628000000;
            var num_days = ((diff_date % 31536000000) % 2628000000)/96400000;

            document.getElementById('show-age').textContent=('อายุ '+Math.floor(num_years)+' ปี');
            // document.write("Number of years: " + Math.floor(num_years) + "<br>");
            // document.write("Number of months: " + Math.floor(num_months) + "<br>");
            // document.write("Number of days: " + Math.floor(num_days) + "<br>");

            // var years = Math.floor(Math.abs(num_years));
            // var months = Math.floor(Math.abs(num_months));
            // var days =  Math.floor(Math.abs(num_days));
            // console.log(years + " years " + months + " months " + days + " days");


        }
</script>

@endsection
