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

<title>ReportBenefit.pdf</title>
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
            width: 100%;
            padding-left: 1em;
        }
        th {
            /* width: 25em; */
            border: 0px solid black;
            font-size: 14pt;
        }
        td {
            border: 0px solid black;
            padding-top: -0.3em;
            font-size: 14pt;
        }
        u {
            border-bottom: 0px dotted #000;
            text-decoration: none;
        }
        label{
            float: right;
            margin-top: -50px;
            font-size: 14pt;
        }
        .col1{
            width: 12em;
        }
        .colPiece{
            width: 2.2em;

        }
        .colNum{
            width: 7em;
            text-align: right;
        }
        .colPer{
            width: 5em;
            text-align: right;
            padding-right: 1em;
        }
        span{
            font-size: 14pt;
        }

        </style>

</head>

<body>
    <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
        <center><b>รายงานข้อมูลสวัสดิการ{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</b></center>
        <span>( ข้อมูลยอดสะสมจำนวนผู้รับสวัสดิการและการจ่ายสวัสดิการแต่ละเรื่อง นับตั้งแต่วันเริ่มก่อตั้งกองทุน )</span>
        <table>
                    <?php
                        $resultCount = 0;
                        $resultMoney = 0;
                        foreach($btypes as $btype){
                            $count = 0;
                            foreach ($benAll as $benall){
                                if($btype->type_bid == $benall->type_bid){
                                    $count = $benall->benCount;
                                }
                            }
                            $money = 0;
                            foreach ($sumBen as $sumben){
                                if($btype->type_bid == $sumben->type_bid){
                                    $money = $sumben->totalBen;
                                }
                            }
                            echo "<tr>";
                            echo    "<td><div class='col1'>".$btype->type_bname."</div></td>
                                    <td><div class='colPiece'>จำนวน</div></td>
                                    <td><div class='colPer'>".number_format($count,0) ."&nbsp;&nbsp;คน</div></td>
                                    <td><div class='colPiece'>จำนวน</td>
                                    <td><div class='colNum'>".number_format($money,2)."&nbsp;&nbsp;บาท</div></td>";
                            echo "</tr>";

                            $resultCount += $count;
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo    "<td><div class='col1'>รวม</div></td>
                                <td><div class='colPiece'>จำนวน</div></td>
                                <td><div class='colPer'>".number_format($resultCount,0) ."&nbsp;&nbsp;&nbsp;คน</div></td>
                                <td><div class='colPiece'>จำนวน</div></td>
                                <td><div class='colNum'>".number_format($resultMoney,2)."&nbsp;&nbsp;บาท</div></td>";
                        echo "</tr>";
                    ?>
        </table>
        <br>
        <span>( ข้อมูลจำนวนผู้รับสวัสดิการและการจ่ายสวัสดิการแต่ละเรื่อง ในรอบหนึ่งปีที่ผ่านมา ) ({{DateThaiShort($dateStart)}} ถึง {{DateThaiShort($dateEnd)}})</span>
        <table>
                    <?php
                        $resultCount = 0;
                        $resultMoney = 0;
                        foreach($btypes as $btype){
                            $count = 0;
                            foreach ($benYear as $benyear){
                                if($btype->type_bid == $benyear->type_bid){
                                    $count = $benyear->benCount;
                                }
                            }
                            $money = 0;
                            foreach ($sumBenYear as $sumbenyear){
                                if($btype->type_bid == $sumbenyear->type_bid){
                                    $money = $sumbenyear->totalBen;
                                }
                            }
                            echo "<tr>";
                            echo    "<td><div class='col1'>".$btype->type_bname."</div></td>
                                    <td><div class='colPiece'>จำนวน</div></td>
                                    <td><div class='colPer'>".number_format($count,0) ."&nbsp;&nbsp;คน</div></td>
                                    <td><div class='colPiece'>จำนวน</td>
                                    <td><div class='colNum'>".number_format($money,2)."&nbsp;&nbsp;บาท</div></td>";
                            echo "</tr>";

                            $resultCount += $count;
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo    "<td><div class='col1'>รวม</div></td>
                                <td><div class='colPiece'>จำนวน</div></td>
                                <td><div class='colPer'>".number_format($resultCount,0) ."&nbsp;&nbsp;&nbsp;คน</div></td>
                                <td><div class='colPiece'>จำนวน</div></td>
                                <td><div class='colNum'>".number_format($resultMoney,2)."&nbsp;&nbsp;บาท</div></td>";
                        echo "</tr>";
                    ?>
        </table>
</body>
</html>
