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

<title>Member.pdf</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="{{ public_path('css/fontsTHspk.css') }}">
</head>

<body>
    <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
        <table>
                <tr align="center">
                        <th colspan="16">รายชื่อสมาชิก{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</th>
                </tr>
                <thead>
                  <tr align="center">
                      <td><b>ลำดับที่</b></td>
                      <td><b>เลขสมาชิก</b></td>
                      <td><b>เลขประจำตัว ปชช.</b></td>
                      <td><b>ชื่อ-นามสกุล</b></td>
                      <td><b>เพศ</b></td>
                      <td><b>วัน/เดือน/ปีเกิด</b></td>
                      <td><b>อายุ</b></td>
                      <td><b>บ้านเลขที่</b></td>
                      <td><b>หมู่ที่</b></td>
                      <td><b>สถานะ</b></td>
                      <td><b>ลักษณะสมาชิก</b></td>
                      <td><b>วันที่เป็นสมาชิก</b></td>
                      <td><b>วันที่พ้นสภาพ</b></td>
                      <td><b>สาเหตุ</b></td>
                      <td><b>ระยะเวลาของสมาชิก</b></td>
                      <td><b>ยอดเงินสะสม</b></td>
                  </tr>
                </thead>
                <?php $i=1; ?>
                <tbody>

                    @foreach ($mems as $mem)
                    <tr>
                        <td align="center">{{ $i}}</td>
                        <td align="center">{{ $mem->mem_no}}</td>
                        <td align="center">{{ $mem->mem_card_id}}</td>
                        <td>
                            @if($mem->mem_title==1) <?php echo"นาย";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
                            @if($mem->mem_title==2) <?php echo"นาง";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
                            @if($mem->mem_title==3) <?php echo"นางสาว";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
                            @if($mem->mem_title==4) <?php echo"เด็กชาย";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
                            @if($mem->mem_title==5) <?php echo"เด็กหญิง";?>{{ $mem->mem_fname}} {{ $mem->mem_lname}}@endif
                        </td>
                        <td align="center">
                            @if($mem->mem_title==1||$mem->mem_title==4)<?php echo"ชาย";?>@endif
                            @if($mem->mem_title==2||$mem->mem_title==3||$mem->mem_title==5)<?php echo"หญิง";?>@endif
                        </td>
                        <td align="center">
                            {{ DateThaiShort($mem->mem_birthdate) }}
                        </td>
                        <td align="center">
                            <?php
                                $date1 = new DateTime("$dateObj");
                                $date2 = new DateTime("$mem->mem_birthdate");
                                $diff = $date1->diff($date2);
                                //echo $diff->y . " ปี " . $diff->m." เดือน ".$diff->d." วัน ";
                                echo $diff->y . " ปี ";
                            ?>
                        </td>
                        <td align="center">{{ $mem->mem_add_no}}</td>
                        <td align="center">@foreach ($vils as $vil)
                                @if($mem->v_id==$vil->v_id)
                                <?php
                                    $mvname = $vil->v_id;
                                    echo $mvname;
                                ?>@endif
                            @endforeach
                        </td>
                        <td align="center">
                                @if($mem->mem_status==1) <?php echo"ปกติ"; ?> @endif
                                @if($mem->mem_status==2) <?php echo"พ้นสภาพ"; ?> @endif
                        </td>
                        <td align="center">
                            @foreach ($mtypes as $mtype)
                                    @if($mem->type_mid==$mtype->type_mid)
                                    <?php   echo $mtname = $mtype->type_mname;?>@endif
                            @endforeach
                        </td >
                        <td align="center">
                            {{ DateThaiShort($mem->register_date)}}
                        </td>
                        <td align="center">
                            @if($mem->resign_date=="") <?php echo" - ";?>@endif
                            @if($mem->resign_date!=""){{ DateThaiShort($mem->resign_date) }}@endif
                        </td>
                        <td align="center">
                            @if($mem->mem_cause_st=="") <?php echo" - ";?>@endif
                            @if($mem->mem_cause_st!=""){{ $mem->mem_cause_st }}@endif
                        </td>
                        <td align="center">
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
                        </td>
                        <td align="right">
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
                            ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
              </table>

</body>
</html>
