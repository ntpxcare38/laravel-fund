<?php

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

<title>Benefit_{{$dateStart}}.pdf</title>
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
         padding: 0.4in 0.4in 0.4in 0.4in;
         font-size: 16pt;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th{
            border: 0px solid black;
            padding: -0.2em 0.5em 0.5em 0.5em;
            font-size: 14pt;
        }
        td {
            border: 1px solid black;
            padding: -0.2em 0.5em 0em 0.5em;
            font-size: 12pt;
        }
        label{
            float: right;
            margin-top: -30px;
            font-size: 12pt;
        }
        </style>

</head>

<body>
        <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
        {{-- <p align="center"><b>ข้อมูลการจ่าย{{$msgHead}} {{$fund->fund_name}} รหว่าง {{DateThaiShort($dateStart)}} ถึง {{DateThaiShort($dateEnd)}}</b></p> --}}
        <table>
                <tr align="center">
                      <th colspan="7">ข้อมูลการจ่าย{{$msgHead}} {{$fund->fund_name}} รหว่าง {{DateThaiShort($dateStart)}} ถึง {{DateThaiShort($dateEnd)}}</th>
                  </tr>
                <thead>
                  <tr align="center">
                      <td><b>รายการ</b></td>
                      <td align="left"><b>ชื่อ - สกุล</b></td>
                      <td><b>เลขที่สมาชิก</b></td>
                      <td><b>วันที่ทำรายการ</b></td>
                      <td><b>ประเภทสวัสดิการ</b></td>
                      <td align="right"><b>จำนวนเงิน</b></td>
                      <td align="left"><b>หมายเหตุ</b></td>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $total = 0;
                ?>
                @foreach ($bens as $ben)
                <tr>
                        <td align="center">{{ $ben->benefit_id}}</td>
                            @foreach ($mems as $mem)

                                @if($mem->mem_id == $ben->mem_id)
                                <td align="left">
                                        @if($mem->mem_title==1) {{"นาย"}}{{$mem->mem_fname}} {{ $mem->mem_lname}}@endif
                                        @if($mem->mem_title==2) {{"นาง"}}{{$mem->mem_fname}} {{ $mem->mem_lname}}@endif
                                        @if($mem->mem_title==3) {{"นางสาว"}}{{$mem->mem_fname}} {{ $mem->mem_lname}}@endif
                                        @if($mem->mem_title==4) {{"เด็กชาย"}}{{$mem->mem_fname}} {{ $mem->mem_lname}}@endif
                                        @if($mem->mem_title==5) {{"เด็กหญิง"}}{{$mem->mem_fname}} {{ $mem->mem_lname}}@endif
                                </td>
                                <td align="center">
                                    {{ $mem->mem_no}}
                                </td>
                                @endif
                            @endforeach
                        <td align="center">{{ DateThaiShort($ben->benefit_date)}}</td>
                        <td align="center">
                            @foreach ($btypes as $bype)
                                @if($bype->type_bid == $ben->type_bid){{ $bype->type_bname}}@endif
                            @endforeach
                        </td>
                        <td align="right">{{ number_format($ben->benefit_price,2) }}</td>
                        <?php $total += $ben->benefit_price; ?>
                        <td align="left">
                            @if($ben->benefit_annotation ==''){{ '-'}}@else {{ $ben->benefit_annotation}}@endif
                        </td>
                </tr>
                @endforeach
                <tr>
                    <td align="center" colspan="5"><b>รวมทั้งหมด</b></td>
                    <td align="right"><u><b>{{ number_format($total,2) }}</b></u></td>
                    <td align="center"></td>
                </tr>

                </tbody>
              </table>
</body>
</html>
