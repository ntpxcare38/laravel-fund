@extends('main')
@section('title','จัดการข้อมูลสมาชิก')
@section('content')
<?php

    $day = date("d");
    $month = date("m");
    $year = date("Y")+543;
    $dateObj = ("$year-$month-$day");

    date_default_timezone_set('Asia/Bangkok');
    $now = date("d-m-Y H:i:s");

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
<div class="container tbfund">
            <div class="row">
                <div class="col s12 m6 right">
                    <div class="input-field col s12 m6 right-align">
                        <a href="/pdfmemall" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายชื่อทั้งหมด</a>
                    </div>
                    <div class="input-field col s12 m6 right-align">
                        <a href="/reOldMem" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายชื่อผู้สูงอายุ</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m11 right">
            <form id="s_mem" action="search_mem" method="GET" name="search">
                @csrf
                    <div class="input-field col s12 m5">
                            <i class="material-icons prefix">search</i>
                            <input name="per_page" type="hidden" value="{{ request()->per_page }}">
                            <input name="mem_search" type="text" id="mem_search" class="autocomplete" value="{{ request()->mem_search }}">
                            <label for="mem_search">ค้นหาเลขสมาชิก ,เลขบัตรปปช. ,ชื่อ-สกุล</label>
                    </div>
                    <div class="input-field col s12 m2 center">
                            <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                    </div>
            </form>
                    <div class="input-field col s12 m5 right-align">
                        <a href="/mem/create" class="btn waves-effect waves-light btn-black"><i class="material-icons left">person_add</i>เพิ่มสมาชิก</a>
                    </div>
                </div>
                <div class="col s2 m1 perPageList left">
                    <form role="form" class="form-inline" method="get" action='{{ url('/mem') }}'>
                    <label>รายการ
                    <select name="per_page" onchange="this.form.submit()" class="form-control input-sm">
                        <option value=""></option>
                        <option value="10" {{ $mems->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ $mems->perPage() == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ $mems->perPage() == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $mems->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $mems->perPage() == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    </label>
                </div>
            </div>

            <table class="highlight responsive-table centered">
                    <thead>
                      <tr>
                          <th>ลำดับ</th>
                          <th>เลขสมาชิก</th>
                          <th>เลขประจำตัวประชาชน</th>
                          <th>ชื่อ-นามสกุล</th>
                          <th>อายุ</th>
                          <th>บ้านเลขที่</th>
                          <th>หมู่ที่</th>
                          <th>วันที่เข้าสมาชิก</th>
                          <th>สถานะ</th>
                          <th>ดูข้อมูล</th>
                          <th>แก้ไข</th>
                          <th>พิมพ์</th>
                      </tr>
                    </thead>

                    <tbody>

                        @foreach ($mems as $mem)
                        <tr>
                            <td>{{ $mem->mem_id}}</td>
                            <td>{{ $mem->mem_no}}</td>
                            <td>{{ $mem->mem_card_id}}</td>
                            <td>
                                @if($mem->mem_title==1)
                                    นาย{{ $mem->mem_fname}} {{ $mem->mem_lname}}
                                @elseif($mem->mem_title==2)
                                    นาง{{ $mem->mem_fname}} {{ $mem->mem_lname}}
                                @elseif($mem->mem_title==3)
                                    นางสาว{{ $mem->mem_fname}} {{ $mem->mem_lname}}
                                @elseif($mem->mem_title==4)
                                    เด็กชาย{{ $mem->mem_fname}} {{ $mem->mem_lname}}
                                @elseif($mem->mem_title==5)
                                    เด็กหญิง{{ $mem->mem_fname}} {{ $mem->mem_lname}}
                                @endif
                            </td>
                            <td>
                                <?php
                                    $date1 = new DateTime("$dateObj");
                                    $date2 = new DateTime("$mem->mem_birthdate");
                                    $diff = $date1->diff($date2);
                                    echo $mem_age = $diff->y . " ปี ";
                                ?>
                            </td>
                            <td>{{ $mem->mem_add_no}}</td>
                            <td>
                                @foreach ($vils as $vil)
                                    @if($mem->v_id==$vil->v_id)
                                        <?php
                                            $mvname = $vil->v_id." ".$vil->v_name;
                                        ?>
                                        {{$mvname}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ DateThaiShort($mem->register_date)}}</td>
                            <td>
                                @if($mem->mem_status==1)
                                <?php echo $mem_status ="ปกติ"; ?>
                                @elseif($mem->mem_status==2)
                                <font color="red"><?php echo $mem_status ="พ้นสภาพ"; ?></font>
                                @endif
                            </td>

                            {{--  Send Value to Modal --}}
                            <?php
                                // --------------------- mem_birthdate ------------------------
                                $mem_birthdate = DateThaiShort($mem->mem_birthdate);
                                // --------------------- mtype_name ------------------------
                                foreach($mtypes as $mtype){
                                    if($mem->type_mid==$mtype->type_mid){
                                        $mtname = $mtype->type_mname;
                                    }
                                }
                                // --------------------- register_date ------------------------
                                $register_date = DateThaiShort($mem->register_date);
                                // --------------------- resign_date ------------------------
                                if($mem->resign_date==""){
                                    $resign_date = "-";
                                }else{
                                    $resign_date = DateThaiShort($mem->resign_date);
                                }
                                // --------------------- mem_cause_st ------------------------
                                if($mem->mem_cause_st==""){
                                    $mem_cause_st ="-";
                                }else{
                                    $mem_cause_st = $mem->mem_cause_st;
                                }
                                // --------------------- totalDateFund ------------------------
                                if($mem->resign_date==""){
                                    $date1 = new DateTime("$dateObj");
                                }
                                else{
                                    $date1 = new DateTime("$mem->resign_date");
                                }
                                $date2 = new DateTime("$mem->register_date");
                                $diff = $date1->diff($date2);
                                $totalDateFund = $diff->y . " ปี " . $diff->m." เดือน ".$diff->d." วัน ";
                                // --------------------- savings ------------------------
                                if($mem->resign_date==""){
                                    $date1 = new DateTime("$dateObj");
                                }
                                else{
                                    $date1 = new DateTime("$mem->resign_date");
                                }
                                $date2 = new DateTime("$mem->register_date");
                                $diff = $date1->diff($date2);
                                $yearM = (($diff->y)*12)*30;
                                $monthM = ($diff->m)*30;
                                $total = $yearM+$monthM;
                                $savings = number_format($total,2);
                                // --------------------- amount_ben ------------------------
                                $total_ben = 0;
                                $amount_ben = 0;
                                foreach ($bens as $ben){
                                    if($ben->mem_id==$mem->mem_id){
                                        $total_ben += $ben->benefit_price;
                                        $amount_ben = number_format($total_ben,2) ;
                                    }
                                }
                            ?>
                            <td>
                                <div class="btn-edit">
                                    <a href="#" class="modal-trigger" data-toggle="modal" data-target="modal1"
                                    onClick="setBillModal('<?php echo   $mem->mem_id. '\',\''.
                                                                        $mem->mem_no. '\',\''.
                                                                        $mem->mem_card_id. '\',\''.
                                                                        $mem->mem_title. '\',\''.
                                                                        $mem->mem_fname. '\',\''.
                                                                        $mem->mem_lname. '\',\''.
                                                                        $mem_birthdate. '\',\''.
                                                                        $mem_age. '\',\''.
                                                                        $mem->mem_add_no. '\',\''.
                                                                        $mvname. '\',\''.
                                                                        $mem_status. '\',\''.
                                                                        $mtname. '\',\''.
                                                                        $register_date. '\',\''.
                                                                        $resign_date. '\',\''.
                                                                        $mem_cause_st. '\',\''.
                                                                        $totalDateFund. '\',\''.
                                                                        $savings. '\',\''.
                                                                        $amount_ben;?>')">
                                            <i class="small material-icons">pageview</i>
                                        </a>
                                    </div>
                                </td>
                            <td>
                                <div class="btn-edit">
                                    <a href='/mem/{{$mem->mem_id}}/edit'><i class='small material-icons'>mode_edit</i></a>
                                </div>
                            </td>
                            <td>
                                <div class="btn-edit">
                                    <a href="/pdfmem/{{$mem->mem_id}}" target="_blank" ><i class="small material-icons">picture_as_pdf</i></a>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                        @if(count($mems) == 0)
                                <td colspan="12">ไม่พบข้อมูล</td>
                        @endif

                    </tbody>
            </table>
            <br><br>
            <ul class="pagination center">
                {{ $mems->appends(['mem_search' => request()->mem_search, 'per_page' => request()->per_page])->links() }}
            </ul>
</div>

{{-- ------------------------ modal ---------------------- --}}
<div class="showMem">
    <div id="modal1" class="modal">
            <div class="modal-content">
                <h5>ข้อมูลสมาชิก</h5>

                <div class="row">
                    <ul>
                        <li>ลำดับที่ : <label><span id="mem_id" ></span></label></li>
                        <li>เลขที่สมาชิก : <label><span id="mem_no"></span></label></li>
                        <li>เลขประจำตัวประชาชน : <label><span id="mem_card_id"></span></label></li>
                        <li>ชื่อ : <label><span id="mem_title"></span><span id="mem_fname"> </span></label></li>
                        <li>นามสกุล : <label><span id="mem_lname"></span></label></li>
                        <li>เพศ : <label><span id="mem_gender"></span></label></li>
                        <li>เกิดวันที่ : <label><span id="mem_birthdate"></span></label></li>
                        <li>อายุ : <label><span id="mem_age"></span></label></li>
                        <li>บ้านเลขที่ : <label><span id="mem_add_no"></span></label></li>
                        <li>หมู่ที่ : <label><span id="v_id"></span></label></li>
                        <li>สถานะปัจจุบัน : <label><span id="mem_status"></span></label></li>
                        <li>ลักษณะสมาชิก : <label><span id="type_mid"></span></label></li>
                        <li>วันที่เข้าสมาชิก : <label><span id="register_date"></span></label></li>
                        <li>วันที่พ้นสมาชิก : <label><span id="resign_date"></span></label></li>
                        <li>สาเหตุ : <label><span id="mem_cause_st"></span></label></li>
                        <li>ระยะเวลาที่เป็นสมาชิก : <label><span id="totalDateFund"></span></label></li>
                        <li>ยอดสะสม : <label><span id="savings"></span> บาท</label></li>
                        <li>ยอดเบิกสวัสดิการทั้งหมด : <label><span id="amount_ben"></span> บาท</label></li>
                    </ul>
                    <!-- Hidden Input Professor Id -->
                    {{-- <input type="text" name="mem_id" />
                    <input type="text" name="mem_fname" /> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close btn-flat">CLOSE</button>
                </div>
            </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/memberManage.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('autocomplete.fetchMem') }}",
                        method:"GET",
                        success:function(data){
                            var memnoArray = data;
                            let amonutArr = []
                            memnoArray.forEach(value => {
                                //const mergeValue = `${value.mem_no} ${value.mem_fname} ${value.mem_lname}`
                                const mergeValueNo = `${value.mem_no}`
                                const mergeValueCard = `${value.mem_card_id}`
                                const mergeValueFname = `${value.mem_fname}`
                                const mergeValueLname = `${value.mem_lname}`
                                amonutArr[mergeValueNo] = null
                                amonutArr[mergeValueCard] = null
                                amonutArr[mergeValueFname] = null
                                amonutArr[mergeValueLname] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: amonutArr,
                                onAutocomplete: function(data) {
                                   $('#s_mem').submit();
                                },
                                limit :4
                            });
                        }
                        ,
                        error: function (err) {
                            console.log(err);
                        }

                    })


    });
</script>
@endsection
