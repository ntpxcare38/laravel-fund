@extends('main-mem')
@section('title','ประวัติการเบิกสวัสดิการ')
@section('content')

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

<div class="container tbshow">
        <div class="row">
                <div class="col s12 m12">
                    <a href="/pdfBenMem/{{$mem->mem_id}}" target="_blank" class="waves-effect waves-light btn right"><i class="material-icons left">picture_as_pdf</i>พิมพ์</a>
                    <h5 class="left">ประวัติการเบิกสวัสดิการ</h5>
                </div>
        </div>
        <table class="highlight responsive-table">
                <thead>

                  <tr>
                      <th class="center-align">รายการ</th>
                      <th class="center-align">วันที่ทำรายการ</th>
                      <th>สวัสดิการ</th>
                      <th>หมายเหตุ</th>
                      <th class="right-align">จำนวนเงิน</th>
                  </tr>
                </thead>

                <tbody>

                    @foreach ($bens->reverse() as $ben)
                    <tr>
                        <td class="center-align">{{ $ben->benefit_id}}</td>
                        <td class="center-align">{{ DateThaiShort($ben->benefit_date)}}</td>
                        <td>@foreach ($btypes as $btype)
                                @if($ben->type_bid==$btype->type_bid)
                                    {{$btype->type_bname}}
                                @endif
                            @endforeach
                        </td>
                        <td>@if($ben->benefit_annotation=='')
                                {{'-'}}
                            @endif{{ $ben->benefit_annotation}}</td>
                        <td class="right-align">{{ number_format($ben->benefit_price, 2) }} บาท</td>
                    </tr>
                    @endforeach
                    @if($bensCount == 0)
                    <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td><label>ไม่มีข้อมูลการเบิก</label></td>
                           <td></td>
                    </tr>
                    @endif
                    @foreach($sumBen as $sum)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>รวมทั้งสิ้น</td>
                        <td class="right-align">{{ number_format($sum->benefit_total, 2) }} บาท</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <br><br>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/benefit.js') }}"></script>
@endsection
