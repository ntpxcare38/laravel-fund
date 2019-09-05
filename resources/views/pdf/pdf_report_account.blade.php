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

    $totalRevenue = 0;
    $totalExpend = 0 ;
    $totalRevenueFil = 0;
    $totalExpendFil = 0 ;
?>
<!DOCTYPE html>
<html>
<head>

<title>reportaccount.pdf</title>
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
         padding: 0.8in 1in;
         font-size: 16pt;
        }
        table {
            border-collapse: collapse;
            margin: 0 auto;
        }
        table{
        }

        th, td {
            border: 1px solid black;
            padding: -7px 5px 0px 5px;
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
        .col1{
            width: 20em;
            padding: 0 0.5em;
        }
        .col2{
            width: 7em;
            padding: 0 0.8em;
            text-align: right;
        }

        </style>

</head>

<body>
        <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
        <center><b>รายงานบัญชีรายรับ-รายจ่าย{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</b></center>
        <br>
        <table>
            <tr>
                <th><div class='col1'>รายการรับ (ยอดสะสมตั้งแต่ก่อตั้งกองทุน)</div></th>
                <th><div class='col2'>จำนวนเงิน (บาท)</div></th>
            </tr>
            <tr>
                <th><div class='col1'>๑.รายรับ</div></th>
                <th></th>
            </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==1){

                                $money = 0;
                                foreach ($sumAcc as $sumacc){
                                    if($gac->group_acid == $sumacc->group_acid){
                                        $money = $sumacc->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายรับ</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalRevenue += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>๒.รายได้</div></th>
                        <th></th>
                    </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==2){

                                $money = 0;
                                foreach ($sumAcc as $sumacc){
                                    if($gac->group_acid == $sumacc->group_acid){
                                        $money = $sumacc->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายรับ</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalRevenue += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>รวมยอดบัญชีรายรับ</div></th><th><div class='col2'>{{number_format($totalRevenue,2)}}</div></th>
                    </tr>
        </table>
        <br>
        <table>
                <tr>
                    <th><div class='col1'>รายการจ่าย (ยอดสะสมตั้งแต่ก่อตั้งกองทุน)</div></th>
                    <th><div class='col2'>จำนวนเงิน (บาท)</div></th>
                </tr>
                <tr>
                    <th><div class='col1'>๑.รายจ่าย</div></th>
                    <th></th>
                </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($sumBen as $sum){
                            echo "<tr>";
                                echo "<td><div class='col1'>จ่ายสวัสดิการสมาชิก</div></td><td><div class='col2'>".number_format($sum->totalBen, 2)."</div></td>";
                            echo "</tr>";

                            $resultMoney += $sum->totalBen;
                        }
                        foreach($gacs as $gac){
                            if($gac->type_acc==3){

                                $money = 0;
                                foreach ($sumAcc as $sumacc){
                                    if($gac->group_acid == $sumacc->group_acid){
                                        $money = $sumacc->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }

                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายจ่าย</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalExpend += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>๒.ค่าใช้จ่าย</div></th>
                        <th></th>
                    </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==4){

                                $money = 0;
                                foreach ($sumAcc as $sumacc){
                                    if($gac->group_acid == $sumacc->group_acid){
                                        $money = $sumacc->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }

                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมค่าใช้จ่าย</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalExpend += $resultMoney;
                    ?>
        <tr>
                <th><div class='col1'>รวมยอดบัญชีรายจ่าย</div></th><th><div class='col2'>{{number_format($totalExpend,2)}}</div></th>
            </tr>
</table>
<center><b>รายงานบัญชีรายรับ-รายจ่าย{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</b></center>
        <br>
        <table>
            <tr>
                <th><div class='col1'>รายการรับ (ยอดสะสมระหว่าง {{DateThaiShort($dateStart)}} ถึง {{DateThaiShort($dateEnd)}})</div></th>
                <th><div class='col2'>จำนวนเงิน (บาท)</div></th>
            </tr>
            <tr>
                <th><div class='col1'>๑.รายรับ</div></th>
                <th></th>
            </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==1){

                                $money = 0;
                                foreach ($sumAccFil as $saf){
                                    if($gac->group_acid == $saf->group_acid){
                                        $money = $saf->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายรับ</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalRevenueFil += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>๒.รายได้</div></th>
                        <th></th>
                    </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==2){

                                $money = 0;
                                foreach ($sumAccFil as $saf){
                                    if($gac->group_acid == $saf->group_acid){
                                        $money = $saf->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายรับ</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalRevenueFil += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>รวมยอดบัญชีรายรับ</div></th><th><div class='col2'>{{number_format($totalRevenueFil,2)}}</div></th>
                    </tr>
        </table>
        <br>
        <table>
                <tr>
                    <th><div class='col1'>รายการจ่าย (ยอดสะสมระหว่าง {{DateThaiShort($dateStart)}} ถึง {{DateThaiShort($dateEnd)}})</div></th>
                    <th><div class='col2'>จำนวนเงิน (บาท)</div></th>
                </tr>
                <tr>
                    <th><div class='col1'>๑.รายจ่าย</div></th>
                    <th></th>
                </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($sumBenFil as $sum){
                            echo "<tr>";
                                echo "<td><div class='col1'>จ่ายสวัสดิการสมาชิก</div></td><td><div class='col2'>".number_format($sum->totalBen, 2)."</div></td>";
                            echo "</tr>";

                            $resultMoney += $sum->totalBen;
                        }
                        foreach($gacs as $gac){
                            if($gac->type_acc==3){

                                $money = 0;
                                foreach ($sumAccFil as $saf){
                                    if($gac->group_acid == $saf->group_acid){
                                        $money = $saf->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }

                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมรายจ่าย</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalExpendFil += $resultMoney;
                    ?>
                    <tr>
                        <th><div class='col1'>๒.ค่าใช้จ่าย</div></th>
                        <th></th>
                    </tr>
                    <?php
                        $resultMoney = 0;
                        foreach($gacs as $gac){
                            if($gac->type_acc==4){

                                $money = 0;
                                foreach ($sumAccFil as $saf){
                                    if($gac->group_acid == $saf->group_acid){
                                        $money = $saf->totalAcc;
                                    }
                                }
                                echo "<tr>";
                                echo "<td><div class='col1'>".$gac->group_acname."</div></td><td><div class='col2'>".number_format($money,2)."</div></td>";
                                echo "</tr>";
                            }

                            $resultMoney += $money;
                        }
                        echo "<tr>";
                        echo "<td><div class='col1'>รวมค่าใช้จ่าย</div></td><td><div class='col2'>".number_format($resultMoney,2)."</div></td>";
                        echo "</tr>";
                        $totalExpendFil += $resultMoney;
                    ?>
        <tr>
                <th><div class='col1'>รวมยอดบัญชีรายจ่าย</div></th><th><div class='col2'>{{number_format($totalExpendFil,2)}}</div></th>
            </tr>
</table>

</body>
</html>

