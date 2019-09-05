@extends('main')
@section('title','รายงานสมาชิก')
@section('content')
<div class="container reportMem">
    <div class="row">
        <div class="col s12 m12">
            <div class="col s12 m12 right-align">
                <a href="/pdfreportmemall" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายงาน</a>
            </div>
            <div class="col s12 m12">
                <h5 class="center">รายงานสมาชิก{{$fund->fund_name}} อำเภอ{{$fund->fund_district}} จังหวัด{{$fund->fund_province}}</h5>
            </div>
            <div class="col s12 m7">
                <div class="col s12 m12 left-align"><label>ข้อมูลสมาชิก</label></div>
                <div class="col s8 m8">จำนวนประชากรในตำบล</div><div class="col s4 m4 right-align"> {{ number_format($fund->fund_habitant,0) }} คน </div>
                <div class="col s8 m8">จำนวนสมาชิกแรกตั้ง</div><div class="col s4 m4 right-align">{{ number_format($firstMem,0) }} คน </div>
                <div class="col s8 m8">จำนวนสมาชิก (สะสมจนถึงปัจจุบัน)</div><div class="col s4 m4 right-align"> {{ number_format($countMem,0) }} คน </div>
                <div class="col s8 m8">จำนวนสมาชิก (คงเหลือปัจจุบัน)</div><div class="col s4 m4 right-align"> {{ number_format($countMemOn,0) }} คน </div>
                <div class="col s8 m8">จำนวนสมาชิก (พ้นสภาพ)</div><div class="col s4 m4 right-align"> {{ number_format($countMemOff,0) }} คน </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12">
            <div class="col s12 m6">
                <div class="col s12 m12 left-align"><label>ลักษณะของสมาชิก (สะสม)</label></div>
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
                    <div class="col s8 m8">{{$mtype->type_mname}}</div><div class="col s4 m4 right-align">{{ number_format( $i,0) }} คน</div>
                    <?php $total += $i; ?>
                @endforeach
                <div class="col s8 m8">รวม</div><div class="col s4 m4 right-align">{{ number_format( $total,0) }} คน</div>
            </div>
            <div class="col s12 m6">
                <div class="col s12 m12 left-align"><label>ลักษณะของสมาชิก (ปัจจุบัน)</label></div>
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
                    <div class="col s8 m8">{{$mtype->type_mname}}</div><div class="col s4 m4 right-align">{{ number_format( $i,0) }} คน</div>
                    <?php $total += $i; ?>
                @endforeach
                <div class="col s8 m8">รวม</div><div class="col s4 m4 right-align">{{ number_format( $total,0) }} คน</div>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="col s12 m12">
        <div class="col s12 m12 left-align"><label>จำนวนสมาชิกในแต่ละปี แยกตามหมู่บ้าน (สะสม)</label></div>
            <table class="responsive-table">
                <tbody>
                    <tr>
                        <td>ปี (พ.ศ.)</td>
                        @foreach ($vils as $vil)
                            <?php
                                $n = $vil->v_id;
                                $i = 0;
                            ?>
                            <td class="right-align">หมู่ {{$n}}</td>
                        @endforeach
                        <td class="right-align">รวมทั้งหมด</td>
                    </tr>
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
                                    <td class="right-align">{{ number_format( $i,0) }}</td>
                                    <?php
                                        $total += $i;
                                    ?>
                                @endforeach
                                <td class="right-align">{{ number_format( $total,0) }} คน </td>
                                <?php $sum += $total; ?>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col s9 m10 center-align">จำนวนสมาชิกทั้งหมด</div>
                <div class="col s2 m2 right-align">{{ number_format( $sum,0) }} คน </div>
            </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
    </div>
    <div class="col s12 m12">
        <div class="col s12 m12 left-align"><label>จำนวนสมาชิกในแต่ละปี แยกตามหมู่บ้าน (ปัจจุบัน)</label></div>
            <table class="responsive-table">
                <tbody>
                    <tr>
                        <td>ปี (พ.ศ.)</td>
                        @foreach ($vils as $vil)
                            <?php
                                $n = $vil->v_id;
                                $i = 0;
                            ?>
                            <td class="right-align">หมู่ {{$n}}</td>
                        @endforeach
                        <td class="right-align">รวมทั้งหมด</td>
                    </tr>
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
                                    <td class="right-align">{{ number_format( $i,0) }}</td>
                                    <?php
                                        $total += $i;
                                    ?>
                                @endforeach
                                <td class="right-align">{{ number_format( $total,0) }} คน </td>
                                <?php $sum += $total; ?>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col s9 m10 center-align">จำนวนสมาชิกทั้งหมด</div>
                <div class="col s2 m2 right-align">{{ number_format( $sum,0) }} คน </div>
            </div>
    </div>
</div>
@endsection
