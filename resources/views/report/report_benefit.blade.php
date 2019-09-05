@extends('main')
@section('title','รายงานสวัสดิการ')
@section('content')
<?php
    $startD = request()->startDate;
    $endD = request()->endDate;

    if($startD==''){
        $startD = "0000-00-00";
        $endD = "0000-00-00";
    }else{
        $startD = request()->startDate;
        $endD = request()->endDate;
    }

?>
<div class="container reportBen">
    <div class="row">
        <div class="col s12 m12">
            <div class="col s12 m12 right-align">
                <a href="/pdfreportBenefit/{{ $startD}}/{{ $endD}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายงาน</a>
            </div>
            <div class="col s12 m12">
                <h6 class="center">รายงานข้อมูลสวัสดิการ{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</h6>
            </div>
            <div class="col s12 m12">
                    <div class="col s12 m12"><label>ข้อมูลยอดสะสมจำนวนผู้รับสวัสดิการและการจ่ายสวัสดิการแต่ละเรื่อง นับตั้งแต่วันเริ่มก่อตั้งกองทุน</label></div>
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
                            echo "<div class='col s12 m5'>".$btype->type_bname."</div>
                                    <div class='col s3 m1 right-align'><label>จำนวน</label></div>
                                    <div class='col s2 m2 right-align'>".number_format($count,0) ."&nbsp;&nbsp;&nbsp;คน</div>
                                    <div class='col s2 m1 right-align'><label>จำนวน</label></div>
                                    <div class='col s5 m3 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            $resultCount += $count;
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m5'>รวม</div>
                            <div class='col s3 m1 right-align'><label>จำนวน</label></div>
                            <div class='col s2 m2 right-align'><u>&nbsp;".number_format($resultCount,0) ."&nbsp;</u>&nbsp;&nbsp;คน</div>
                            <div class='col s2 m1 right-align'><label>จำนวน</label></div>
                            <div class='col s5 m3 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";

                    ?>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12">
            <div class="col s12 m12">
                    <form action="reBenefit" method="GET" name="search">
                        @csrf
                            <div class="input-field col s11 m4">
                                    <i class="material-icons prefix">date_range</i>
                                    <input name="startDate" type="text" id="date1" class="datepicker" value="{{ request()->startDate }}" required>
                                    <label for="icon_prefix">ตั้งแต่วันที่</label>
                            </div>
                            <div class="input-field col s11 m4">
                                <i class="material-icons prefix">date_range</i>
                                <input name="endDate" type="text" id="date2" class="datepicker" value="{{ request()->endDate }}" required>
                                <label for="icon_prefix">สิ้นสุดวันที่</label>
                            </div>
                            <div class="input-field col s12 m2 center-align">
                                <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                            </div>
                    </form>
            </div>
        </div>
        <div class="col s12 m12">
                <div class="col s12 m12"><label>ข้อมูลยอดสะสมจำนวนผู้รับสวัสดิการและการจ่ายสวัสดิการแต่ละเรื่อง ในรอบหนึ่งปีที่ผ่านมา</label></div>
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
                            echo "<div class='col s12 m5'>".$btype->type_bname."</div>
                                    <div class='col s3 m1 right-align'><label>จำนวน</label></div>
                                    <div class='col s2 m2 right-align'>".number_format($count,0) ."&nbsp;&nbsp;&nbsp;คน</div>
                                    <div class='col s2 m1 right-align'><label>จำนวน</label></div>
                                    <div class='col s5 m3 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            $resultCount += $count;
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m5'>รวม</div>
                            <div class='col s3 m1 right-align'><label>จำนวน</label></div>
                            <div class='col s2 m2 right-align'><u>&nbsp;".number_format($resultCount,0) ."&nbsp;</u>&nbsp;&nbsp;คน</div>
                            <div class='col s2 m1 right-align'><label>จำนวน</label></div>
                            <div class='col s5 m3 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";

                    ?>
                </div>
        </div>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/reportBenefit.js') }}"></script>
@endsection
