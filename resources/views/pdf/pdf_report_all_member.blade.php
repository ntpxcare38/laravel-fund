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
?>
<!DOCTYPE html>
<html>
<head>

<title>ReportMember.pdf</title>
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
         padding: 0.8in;
         font-size: 16pt;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            page-break-inside: avoid;
        }

        th{
            border: 0px solid black;
            padding: -0.2em 1.2em 0em 0em;*/
            font-size: 14pt;
        }
        td {
            border: 0px solid black;
            padding: -0.5em 0em 0em 0.5em;*/
            font-size: 14pt;
        }label{
            float: right;
            margin-top: -50px;
            font-size: 12pt;
        }
        .col1{
            width: 12em;
        }
        .col2{
            width: 3em;
            text-align: right;
        }
        .col3{
            width: 4em;
            text-align: right;
        }
        .col4{
            width: 1.5em;
            text-align: right;
        }
        .r-align{
            text-align: right;
        }
        .c-align{
            text-align: center;
        }
        .memYear table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
        }
        .memYear th{
            border: 0px solid black;
            padding: -0.4em 1.2em 0.5em 0em;*/
            font-size: 14pt;
        }
        .memYear td {
            border: 1px solid black;
            padding: -0.4em 0.5em 0.1em 0.5em;*/
            font-size: 14pt;
        }

        </style>

</head>

<body>

        <table>
                <tr>
                    <td colspan="4"><label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label></td>
                </tr>
            <tr>
                <th colspan="4" align="center">รายงานสมาชิก{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</th>
            </tr>
            <tr>
                <th class="col1">ข้อมูลสมาชิก</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>จำนวนประชากรในตำบล</td><td class="col2">จำนวน</td><td class="col3">{{ number_format($fund->fund_habitant,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <td>จำนวนสมาชิกแรกตั้ง</td><td class="col2">จำนวน</td><td class="col3">{{ number_format($firstMem,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <td>จำนวนสมาชิก (สะสมจนถึงปัจจุบัน)</td><td class="col2">จำนวน</td><td class="col3">{{ number_format($countMem,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <td>จำนวนสมาชิก (คงเหลือปัจจุบัน)</td><td class="col2">จำนวน</td><td class="col3">{{ number_format($countMemOn,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <td>จำนวนสมาชิก (พ้นสภาพ)</td><td class="col2">จำนวน</td><td class="col3">{{ number_format($countMemOff,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <th class="col1">ลักษณะของสมาชิก (สะสม)</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php $total = 0; ?>
            @foreach ($mtypes as $mtype)
                <?php
                $n = $mtype->type_mid;
                $i = 0;
                ?>
                    @foreach ($mems as $mem)
                        <?php
                            if($mem->type_mid==$mtype->type_mid){
                                    $i++;
                            }
                        ?>
                    @endforeach
                    <tr>
                        <td>{{$mtype->type_mname}}</td><td class="col2">จำนวน</td><td class="col3">{{ number_format( $i,0) }}</td><td class="col4">คน</td>
                    </tr>
                    <?php $total += $i; ?>
            @endforeach
            <tr>
                <td>รวม</td><td class="col2">จำนวน</td><td class="col3">{{ number_format( $total,0) }}</td><td class="col4">คน</td>
            </tr>
            <tr>
                <th class="col1">ลักษณะของสมาชิก (ปัจจุบัน)</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php $total = 0; ?>
            @foreach ($mtypes as $mtype)
                <?php
                $n = $mtype->type_mid;
                $i = 0;
                ?>
                    @foreach ($mems as $mem)
                        <?php
                            if($mem->type_mid==$mtype->type_mid && $mem->mem_status == 1){
                                    $i++;
                            }
                        ?>
                    @endforeach
                    <tr>
                        <td>{{$mtype->type_mname}}</td><td class="col2">จำนวน</td><td class="col3">{{ number_format( $i,0) }}</td><td class="col4">คน</td>
                    </tr>
                    <?php $total += $i; ?>
            @endforeach
            <tr>
                <td>รวม</td><td class="col2">จำนวน</td><td class="col3">{{ number_format( $total,0) }}</td><td class="col4">คน</td>
            </tr>
        </table>
        <br>
        <div class="memYear">
         <table>
                <thead>
                    @foreach ($vils as $vil)
                        <?php
                            $n = $vil->v_id;
                        ?>
                    @endforeach
                    <tr>
                        <th colspan="{{$n+2}}">จำนวนสมาชิกในแต่ละปี แยกตามหมู่บ้าน (สะสม)</th>
                    </tr>
                    <tr>
                        <td><b>ปี (พ.ศ.)</b></td>
                        @foreach ($vils as $vil)
                            <?php
                                $n = $vil->v_id;
                                $i = 0;
                            ?>
                            <td class="r-align" border="1"><b>หมู่ {{$n}}</b></td>
                        @endforeach
                        <td class="r-align"><b>รวมทั้งหมด</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $sum = 0; ?>
                    @foreach ($year as $ym )
                        <tr>
                            <td>{{ $ym->year }}</td>
                                <?php
                                    $total = 0;
                                ?>
                                @foreach ($vils as $vil)
                                <?php
                                    $n = $vil->v_id;
                                    $i = 0;
                                ?>
                                    @foreach ($mems as $mem)
                                    <?php
                                        $strYear = date("Y",strtotime($mem->register_date));
                                        if($mem->v_id==$vil->v_id){
                                                if($strYear == $ym->year){
                                                    $i++;
                                                }
                                        }
                                    ?>
                                    @endforeach
                                    <td class="r-align">{{ number_format( $i,0) }}</td>
                                    <?php
                                        $total += $i;
                                    ?>
                                @endforeach
                                <td class="r-align">{{ number_format( $total,0) }} คน </td>
                                <?php $sum += $total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="{{$n+1}}" class="c-align">จำนวนสมาชิกทั้งหมด</td>
                        <td colspan="1" class="r-align">{{ number_format( $sum,0) }} คน </td>
                    </tr>
                </tbody>
            </table>
            <table>
                    <thead>
                        @foreach ($vils as $vil)
                            <?php
                                $n = $vil->v_id;
                            ?>
                        @endforeach
                        <tr>
                            <th colspan="{{$n+2}}">จำนวนสมาชิกในแต่ละปี แยกตามหมู่บ้าน (ปัจจุบัน)</th>
                        </tr>
                        <tr>
                            <td><b>ปี (พ.ศ.)</b></td>
                            @foreach ($vils as $vil)
                                <?php
                                    $n = $vil->v_id;
                                    $i = 0;
                                ?>
                                <td class="r-align" border="1"><b>หมู่ {{$n}}</b></td>
                            @endforeach
                            <td class="r-align"><b>รวมทั้งหมด</b></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $sum = 0; ?>
                    @foreach ($year as $ym )
                        <tr>
                            <td>{{ $ym->year }}</td>
                                <?php
                                    $total = 0;
                                ?>
                                @foreach ($vils as $vil)
                                <?php
                                    $n = $vil->v_id;
                                    $i = 0;
                                ?>
                                    @foreach ($mems as $mem)
                                    <?php
                                        $strYear = date("Y",strtotime($mem->register_date));
                                        if($mem->v_id==$vil->v_id && $mem->mem_status == 1){
                                                if($strYear == $ym->year){
                                                    $i++;
                                                }
                                        }
                                    ?>
                                    @endforeach
                                    <td class="r-align">{{ number_format( $i,0) }}</td>
                                    <?php
                                        $total += $i;
                                    ?>
                                @endforeach
                                <td class="r-align">{{ number_format( $total,0) }} คน </td>
                                <?php $sum += $total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="{{$n+1}}" class="c-align">จำนวนสมาชิกทั้งหมด</td>
                        <td colspan="1" class="r-align">{{ number_format( $sum,0) }} คน </td>
                    </tr>
                </tbody>
            </table>
        </div>
</body>
</html>
