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
<!DOCTYPE html>
<html>
<head>

<title>{{$mem->mem_no}}.pdf</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        html{
            margin: 0px;
        }
        body{
         font-family: "THSarabunNew";
         padding: 1in;
         font-size: 16pt;
        }
        table {
            border-collapse: collapse;
        }
        table{
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 0px 5px;
            font-size: 14pt;
        }
        u {
            border-bottom: 1px dotted #000;
            text-decoration: none;
        }label{
            float: right;
            margin-top: -50px;
            font-size: 14pt;
        }

        </style>

</head>

<body>
<label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
<b>ข้อมูลสมาชิก คุณ{{ $mem->mem_fname}} {{ $mem->mem_lname}}</b><br>
ลำดับที่ <u>&nbsp;&nbsp;{{ $mem->mem_id}}&nbsp;&nbsp;</u>&nbsp;&nbsp;
เลขที่สมาชิก <u>&nbsp;&nbsp;{{ $mem->mem_no}}&nbsp;&nbsp;</u>&nbsp;&nbsp;
เลขประจำตัวประชาชน <u>&nbsp;&nbsp;{{ $mem->mem_card_id}}&nbsp;&nbsp;</u>&nbsp;&nbsp;
<br>
ชื่อ-นามสกุล  <u>&nbsp;&nbsp;@if($mem->mem_title==1) <?php echo"นาย";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
@if($mem->mem_title==2) <?php echo"นาง";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
@if($mem->mem_title==3) <?php echo"นางสาว";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
@if($mem->mem_title==4) <?php echo"เด็กชาย";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
@if($mem->mem_title==5) <?php echo"เด็กหญิง";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif&nbsp;&nbsp;</u>
เพศ <u>&nbsp;&nbsp;@if($mem->mem_title==1||$mem->mem_title==4)<?php echo"ชาย";?>@endif
@if($mem->mem_title==2||$mem->mem_title==3||$mem->mem_title==5)<?php echo"หญิง";?>@endif&nbsp;&nbsp;</u>&nbsp;&nbsp;
เกิดวันที่ <u>&nbsp;&nbsp;{{ DateThaiShort($mem->mem_birthdate) }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
อายุ <u>&nbsp;&nbsp;
    <?php
        $date1 = new DateTime("$dateObj");
        $date2 = new DateTime("$mem->mem_birthdate");
        $diff = $date1->diff($date2);
        echo $diff->y;
    ?>&nbsp;&nbsp;</u>ปี&nbsp;&nbsp;
<br>
ที่อยู่บ้านเลขที่ <u>&nbsp;&nbsp;{{ $mem->mem_add_no }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
หมู่ที่ <u>&nbsp;&nbsp;@foreach ($vils as $vil)
        @if($vil->v_id==$mem->v_id) {{$vil->v_id}} {{$vil->v_name}}@endif
    @endforeach&nbsp;&nbsp;</u>&nbsp;&nbsp;
ตำบล <u>&nbsp;&nbsp;{{ $fund->fund_tumbol }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
<br>
อำเภอ <u>&nbsp;&nbsp;{{ $fund->fund_district }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
จังหวัด <u>&nbsp;&nbsp;{{ $fund->fund_province }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
รหัสไปรษณีย์ <u>&nbsp;&nbsp;{{$fund->fund_zipcode}}&nbsp;&nbsp;</u>&nbsp;&nbsp;
<br>
สถานะปัจจุบัน <u>&nbsp;&nbsp;@if($mem->mem_status==1) <?php echo"ปกติ";?>@endif
@if($mem->mem_status==2) <?php echo"พ้นสภาพ";?>@endif&nbsp;&nbsp;</u>&nbsp;&nbsp;
ลักษณะสมาชิก <u>&nbsp;&nbsp;@foreach($mtypes as $mtype)
        @if($mtype->type_mid==$mem->type_mid){{$mtype->type_mname}}@endif
    @endforeach&nbsp;&nbsp;</u>&nbsp;&nbsp;
 <br>
วันที่เข้าสมาชิก <u>&nbsp;&nbsp;{{ DateThaiShort($mem->register_date) }}&nbsp;&nbsp;</u>&nbsp;&nbsp;
วันที่พ้นสมาชิก <u>&nbsp;&nbsp;@if($mem->resign_date=="") <?php echo" - ";?>@endif
@if($mem->resign_date!=""){{ DateThaiShort($mem->resign_date) }}@endif&nbsp;&nbsp;</u>&nbsp;&nbsp;
สาเหตุ <u>&nbsp;&nbsp;@if($mem->mem_cause_st=="") <?php echo" - ";?>@endif
@if($mem->mem_cause_st!=""){{ $mem->mem_cause_st }}@endif&nbsp;&nbsp;</u>&nbsp;&nbsp;
<br>
ระยะเวลาที่เป็นสมาชิก <u>&nbsp;&nbsp;
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
 ?>&nbsp;&nbsp;</u>&nbsp;&nbsp;
ยอดเงินสะสมปัจจุบัน <u>&nbsp;&nbsp;
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
?>&nbsp;&nbsp;</u>บาท&nbsp;&nbsp;

</body>
</html>
