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

<title>benefit_{{$mem->mem_no}}.pdf</title>
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
         padding: 1in 0.9in;
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
            padding: -4.0px 5px 2px 5px;
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
<b>ข้อมูลประวัติการเบิกสวัสดิการ คุณ{{ $mem->mem_fname}} {{ $mem->mem_lname}}</b><br>
เลขที่สมาชิก <u>&nbsp;&nbsp;{{ $mem->mem_no}}&nbsp;&nbsp;</u>&nbsp;&nbsp;
เลขประจำตัวประชาชน <u>&nbsp;&nbsp;{{ $mem->mem_card_id}}&nbsp;&nbsp;</u>&nbsp;&nbsp;

<br><br><b>ประวัติการเบิกสวัสดิการ</b>
<table>
        <thead>
          <tr>
              <th align="center">ลำดับที่</th>
              <th align="center">วันที่ทำรายการ</th>
              <th>สวัสดิการ</th>
              <th>หมายเหตุ</th>
              <th align="right">จำนวนเงิน</th>
          </tr>
        </thead>
        <?php $i=1; ?>
        <tbody>
            @foreach ($bens as $ben)
            <tr>
                <td align="center">{{ $i}}</td>
                <td align="center">{{ DateThaiShort($ben->benefit_date)}}</td>
                <td>@foreach ($btypes as $btype)
                    @if($ben->type_bid==$btype->type_bid)
                    <?php
                        echo $btype->type_bname;
                    ?>
                    @endif
                @endforeach
                </td>
                <td>@if($ben->benefit_annotation=='')
                    <?php
                        echo "-";
                    ?>
                    @endif{{ $ben->benefit_annotation}}</td>
                <td align="right">{{ number_format($ben->benefit_price, 2) }}</td>
            </tr>
            <?php $i++; ?>
            @endforeach
        </tbody>
      </table>
      <p align="right">
      <b>รวมทั้งสิ้น
      @foreach($sumBen as $sum)
        {{ number_format($sum->benefit_total, 2) }} บาท
      @endforeach
      </b>
      </p>
</body>
</html>
