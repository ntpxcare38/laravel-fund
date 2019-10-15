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

<title>old_member_{{$yearOldMem}}.pdf</title>
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
         padding: 0.5in 0.2in 0.2in 0.2in;
         font-size: 14pt;
        }
        table {
            border-collapse: collapse;
        }
        table{
            width: 100%;
        }
        th{
            border: 1px solid black;
            padding: 0px 2px;
            font-size: 8pt;
        }
        td {
            border: 1px solid black;
            padding: 0px 2px;
            font-size: 10pt;
        }
        label{
            float: right;
            margin-top: -50px;
            font-size: 12pt;
        }

        </style>

</head>

<body>
    <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
    <center><b>รายชื่อผู้สูงอายุ ปี {{$yearOldMem}} {{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</b></center><br>
        <table>
                <thead>
                  <tr align="center">
                      <th>ลำดับที่</th>
                      <th>เลขสมาชิก</th>
                      <th>เลขประจำตัวประชาชน</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>เพศ</th>
                      <th>วัน/เดือน/ปีเกิด</th>
                      <th>อายุ</th>
                      <th>บ้านเลขที่</th>
                      <th>หมู่ที่</th>
                      <th>สถานะ</th>
                      <th>ลักษณะสมาชิก</th>
                      <th>วันที่เป็นสมาชิก</th>
                      <th>วันที่พ้นสภาพสมาชิก</th>
                      <th>สาเหตุ</th>
                      <th>ระยะเวลาที่เป็นสมาชิก</th>
                      <th>ยอดเงินสะสมปัจจุบัน</th>
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
