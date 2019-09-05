@extends('main-mem')
@section('title','แสดงข้อมูลผู้ใช้')
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
        $strYear = date("Y",strtotime($now))+543;
        $strMonth= date("n",strtotime($now));
        $strDay= date("j",strtotime($now));
        $strHour= date("H",strtotime($now));
        $strMinute= date("i",strtotime($now));
        $strSeconds= date("s",strtotime($now));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "วันที่ "."$strDay $strMonthThai $strYear"." เวลา "."$strHour:$strMinute"." น.";

    }
    function DateThaiShort($now)
    {
        $strYear = date("Y",strtotime($now));
        $strMonth= date("n",strtotime($now));
        $strDay= date("j",strtotime($now));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";


    }
?>
<div class="container content-fund">
        <div class="show-mem">
        <div class="row">
                <div class="col s12 m12">
                    <a href="/pdfProMem/{{$mem->mem_id}}" target="_blank" class="waves-effect waves-light btn right"><i class="material-icons left">picture_as_pdf</i>พิมพ์</a>
                    <h5 class="left">ข้อมูลผู้ใช้งาน</h5>
                </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                ลำดับที่ : {{$mem->mem_id}}
            </div>
            <div class="col s12 m6">
                เลขที่สมาชิก : {{$mem->mem_no}}
            </div>
            <div class="col s12 m6">
                เลขบัตรประชาชน : {{$mem->mem_card_id}}
            </div>
            <div class="col s12 m6">
                ชื่อ :
                @if($mem->mem_title==1)นาย@endif
                @if($mem->mem_title==2)นาง@endif
                @if($mem->mem_title==3)นางสาว@endif
                @if($mem->mem_title==4)เด็กชาย@endif
                @if($mem->mem_title==5)เด็กหญิง@endif
                {{$mem->mem_fname}} {{$mem->mem_lname}}
            </div>

            <div class="col s12 m6">
                วัน/เดือน/ปีเกิด : {{ DateThaiShort($mem->mem_birthdate) }}
            </div>
            <div class="col s12 m6">
                อายุ : <?php
                            $date1 = new DateTime("$dateObj");
                            $date2 = new DateTime("$mem->mem_birthdate");
                            $diff = $date1->diff($date2);
                            echo $diff->y;
                        ?> ปี
            </div>
            <div class="col s12 m6">
                เพศ :
                    @if($mem->mem_title==1||$mem->mem_title==4)<span>ชาย</span>  @endif
                    @if($mem->mem_title==2||$mem->mem_title==3||$mem->mem_title==5)<span>หญิง</span>  @endif

            </div>
            <div class="col s12 m6">
                @foreach ($mtypes as $mtype)
                    @if($mtype->type_mid==$mem->type_mid)
                        ลักษณะสมาชิก : {{$mtype->type_mname}}
                    @endif
                @endforeach
            </div>
            <div class="col s12 m6">
                บ้านเลขที่ : {{$mem->mem_add_no}}
            </div>
            <div class="col s12 m6">
                @foreach ($vils as $vil)
                    @if($vil->v_id==$mem->v_id)
                        หมู่ : {{$vil->v_id}} {{$vil->v_name}}
                    @endif
                @endforeach
            </div>
            <div class="col s12 m6">
                ตำบล : {{ $fund->fund_tumbol }}
            </div>
            <div class="col s12 m6">
                อำเภอ : {{ $fund->fund_district }}
            </div>
            <div class="col s12 m6">
                จังหวัด : {{ $fund->fund_province }}
            </div>
            <div class="col s12 m6">
                รหัสไปรษณีย์ : {{$fund->fund_zipcode}}
            </div>
            <div class="col s12 m6">
                วันที่เข้าสมาชิก : {{ DateThaiShort($mem->register_date) }}
            </div>
            <div class="col s12 m6">
                วันที่พ้นจากสมาชิก :
                @if($mem->resign_date=='')
                    <span>-</span>
                @else
                    {{ DateThaiShort($mem->resign_date) }}
                @endif
            </div>
            <div class="col s12 m6">
                สาเหตุ :
                @if($mem->mem_cause_st=='')
                    <span>-</span>
                @else
                    {{$mem->mem_cause_st}}
                @endif
            </div>
            <div class="col s12 m6">
                ระยะเวลาที่เป็นสมาชิก :
                <?php
                    if($mem->resign_date==""){
                        $date1 = new DateTime("$dateObj");
                    }
                    else{
                        $date1 = new DateTime("$mem->resign_date");
                    }
                    $date2 = new DateTime("$mem->register_date");
                    $diff = $date1->diff($date2);
                    echo $diff->y . " ปี " . $diff->m." เดือน ".$diff->d." วัน ";
                ?>
            </div>
            <div class="col s12 m6">
                ยอดเงินสะสมปัจจุบัน :
                <?php
                    if($mem->resign_date==""){
                        $date1 = new DateTime("$dateObj");
                    }
                    else{
                        $date1 = new DateTime("$mem->resign_date");
                    }
                    $date2 = new DateTime("$mem->register_date");
                    $diff = $date1->diff($date2);
                    $yearM = (($diff->y)*12)*30;
                    $monthM = ($diff->m)*30;
                    $total = $yearM+$monthM;
                    echo number_format($total,2);
                ?> บาท
            </div>
            <div class="col s12 m6">
                @if($mem->mem_status==1)สถานะ : ปกติ</span>@endif
                @if($mem->mem_status==2)<span>สถานะ : พ้นจากสมาชิก</span>@endif
            </div>
            </p>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/person.js') }}"></script>

@endsection




