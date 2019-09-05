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

<title>Personnel.pdf</title>
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
         padding: 0.8in 1in 1in 1in;
         font-size: 16pt;
        }
        table {
            border-collapse: collapse;
        }
        table{
            width: 100%;
        }

        th{
            border: 0px solid black;
            padding: 0.5em 0.5em;
            font-size: 16pt;
            page-break-inside: avoid;
            white-space: nowrap;
        }
        td{
            border: 1px solid black;
            padding: -0.3em 0.1em 0.2em 0.1em;
            font-size: 14pt;
            page-break-inside: avoid;
            white-space: nowrap;
        }label{
            float: right;
            margin-top: -50px;
            font-size: 12pt;
        }

        </style>

</head>

<body>
        <label>{{"พิมพ์เมื่อ : ".DateThai($now)}}</label>
        <table>
                <tr align="center">
                        <th colspan="7">รายชื่อคณะกรรมการ{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</th>
                </tr>
                <thead>
                  <tr align="center">
                      <td><b>ลำดับ</b></td>
                      <td><b>ชื่อ-นามสกุล</b></td>
                      <td><b>ตำแหน่งในกองทุน</b></td>
                      <td><b>ตำแหน่งในชุมชน</b></td>
                      <td><b>เบอร์โทรศัพท์</b></td>
                      <td><b>ประเภทผู้ใช้</b></td>
                      <td><b>Username</b></td>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach ($pers as $per)
                <tr>
                        <td align="center">{{ $i}}</td>
                        <td align="center">@if($per->p_title==1) <?php echo"นาย";?>{{$per->p_fname}} {{ $per->p_lname}}@endif
                            @if($per->p_title==2) <?php echo"นาง";?>{{$per->p_fname}} {{ $per->p_lname}}@endif
                            @if($per->p_title==3) <?php echo"นางสาว";?>{{$per->p_fname}} {{ $per->p_lname}}@endif

                        </td>
                        <td align="center">@foreach ($pfunds as $pfund)
                            @if($per->position_fid==$pfund->position_fid) <?php echo $pfund->position_fname; ?>@endif
                        @endforeach</td>
                        <td align="center">@foreach ($pcoms as $pcom)
                            @if($per->position_cid==$pcom->position_cid) <?php echo $pcom->position_cname; ?>@endif
                        @endforeach</td>
                        <td align="center">{{ $per->p_tel}}</td>
                        <td align="center">@if($per->type_pid==1) <?php echo"ผู้ดูและระบบ"; ?> @endif
                            @if($per->type_pid==2) <?php echo"ผู้บริหาร/กรรมการ"; ?> @endif
                            @if($per->type_pid==3) <?php echo"เจ้าหน้าที่"; ?> @endif
                        </td>
                        <td align="center">{{ $per->p_username}}</td>
                </tr>
                <?php $i++; ?>
                @endforeach


                </tbody>
              </table>
</body>
</html>
