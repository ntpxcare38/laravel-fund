@extends('main')
@section('title','รายงานบัญชีรายรับ-รายจ่าย')
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

    $totalRevenue = 0;
    $totalExpend = 0 ;
    $totalRevenueFil = 0;
    $totalExpendFil = 0 ;

?>
<div class="container reportAcc">
    <div class="row">
        <div class="col s12 m12">
            <div class="col s12 m12 right-align">
                <a href="/pdfreportAccount/{{ $startD}}/{{ $endD}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายงาน</a>
            </div>
            <div class="col s12 m12">
                <h6 class="center">รายงานบัญชีรายรับ-รายจ่าย{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</h6>
            </div>
            <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายการรับ (ยอดสะสม)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายรับ</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalRevenue += $resultMoney;
                    ?>
            </div>
            <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายได้ (ยอดสะสม)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";

                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายได้</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalRevenue += $resultMoney;
                    ?>
            </div>
            <div class="col s12 m12">
                    <div class="col s12 m12"><label></label></div>
                    <div class='col s12 m6'>รวมยอดบัญชีรายรับ</div>
                    <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                    <div class='col s6 m4 right-align'><u>&nbsp;{{number_format($totalRevenue,2)}}&nbsp;</u>&nbsp;บาท</div>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col s12 m12">
                <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายการจ่าย (ยอดสะสม)</label></div>
                    <?php
                        $resultMoney = 0;
                        foreach($sumBen as $sum){
                            echo "<div class='col s12 m6'>จ่ายสวัสดิการสมาชิก</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($sum->totalBen, 2)."&nbsp;&nbsp;บาท</div>";
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายจ่าย</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalExpend += $resultMoney;
                    ?>
                </div>

                <div class="col s12 m12">
                        <div class="col s12 m12"><label>ค่าใช้จ่าย (ยอดสะสม)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";

                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมค่าใช้จ่าย</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalExpend += $resultMoney;
                    ?>
                </div>
                <div class="col s12 m12">
                    <div class="col s12 m12"><label></label></div>
                    <div class='col s12 m6'>รวมยอดบัญชีรายจ่าย</div>
                    <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                    <div class='col s6 m4 right-align'><u>&nbsp;{{number_format($totalExpend,2)}}&nbsp;</u>&nbsp;บาท</div>
                </div>
        </div>
    </div>
<hr>
<br>
    <div class="row">
        <div class="col s12 m12">
                <form action="reAccount" method="GET" name="search">
                    @csrf
                        <div class="input-field col s11 m3">
                            <i class="material-icons prefix">date_range</i>
                            <input name="startDate" type="text" id="date1" class="datepicker" value="{{ request()->startDate }}" required>
                            <label for="icon_prefix">ตั้งแต่วันที่</label>
                        </div>
                        <div class="input-field col s11 m3">
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
    <div class="row">
        <div class="col s12 m12">
                <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายการรับ (ในรอบปี)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายรับ</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalRevenueFil += $resultMoney;
                    ?>
                </div>
                <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายได้ (ในรอบปี)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายได้</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalRevenueFil += $resultMoney;
                    ?>
                </div>
                <div class="col s12 m12">
                        <div class="col s12 m12"><label></label></div>
                        <div class='col s12 m6'>รวมยอดบัญชีรายรับ</div>
                        <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                        <div class='col s6 m4 right-align'><u>&nbsp;{{number_format($totalRevenueFil,2)}}&nbsp;</u>&nbsp;บาท</div>
                </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col s12 m12">
                <div class="col s12 m12">
                    <div class="col s12 m12"><label>รายการจ่าย (ในรอบปี)</label></div>
                    <?php
                        $resultMoney = 0;
                        foreach($sumBenFil as $sum){
                            echo "<div class='col s12 m6'>จ่ายสวัสดิการสมาชิก</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($sum->totalBen, 2)."&nbsp;&nbsp;บาท</div>";
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";
                            }
                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมรายจ่าย</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalExpendFil += $resultMoney;
                    ?>
                </div>
                <div class="col s12 m12">
                    <div class="col s12 m12"><label>ค่าใช้จ่าย (ในรอบปี)</label></div>
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
                            echo "<div class='col s12 m6'>".$gac->group_acname."</div>
                                <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                                <div class='col s6 m4 right-align'>".number_format($money,2)."&nbsp;&nbsp;บาท</div>";

                            }

                            $resultMoney += $money;
                        }
                        echo "<div class='col s12 m6'>รวมค่าใช้จ่าย</div>
                            <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                            <div class='col s6 m4 right-align'><u>&nbsp;".number_format($resultMoney,2)."&nbsp;</u>&nbsp;บาท</div>";
                        $totalExpendFil += $resultMoney;
                    ?>
                </div>
                <div class="col s12 m12">
                    <div class="col s12 m12"><label></label></div>
                    <div class='col s12 m6'>รวมยอดบัญชีรายจ่าย</div>
                    <div class='col s6 m2 right-align'><label>จำนวน</label></div>
                    <div class='col s6 m4 right-align'><u>&nbsp;{{number_format($totalExpendFil,2)}}&nbsp;</u>&nbsp;บาท</div>
                </div>
        </div>
    </div>
<hr>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/reportBenefit.js') }}"></script>
@endsection
