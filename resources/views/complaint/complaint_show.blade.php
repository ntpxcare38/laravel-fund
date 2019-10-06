@extends('main')
@section('title','เรื่องร้องเรียนกองทุน')
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
            <div class="title col s12 m12 left">
                <h5><i class="tiny material-icons">chat</i> ข้อมูลการร้องเรียน</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s10 m10 right">
                <form action="search_comp" method="GET" name="search">
                        @csrf
                        <div class="input-field col s1 m8">
                        </div>
                        <div class="input-field col s8 m3">
                            <i class="material-icons prefix">date_range</i>
                            <input name="per_page" type="hidden" value="{{ request()->per_page }}">
                            <input name="comp_searchdate" type="text" id="icon_prefix" class="datepicker" onchange="submit()" value="{{ request()->comp_searchdate }}">
                            <label for="icon_prefix">ตั้งแต่วันที่</label>
                        </div>
                        <div class="input-field col s2 m1">
                            <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                        </div>
                </form>
            </div>
            <div class="col s2 m1 perPageList left">
                    <form role="form" class="form-inline" method="get" action='{{ url('/comp_view') }}'>
                    <label>รายการ
                    <select name="per_page" onchange="this.form.submit()" class="form-control input-sm">
                        <option value=""></option>
                        <option value="10" {{ $comps->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ $comps->perPage() == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ $comps->perPage() == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $comps->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $comps->perPage() == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    </label>
            </div>
        </div>

            <table class="highlight responsive-table">
                    <thead>

                      <tr>
                          <th class="center-align">รายการ</th>
                          <th class="center-align">วันที่ร้องเรียน</th>
                          <th class="left-align">เรื่องร้องเรียน</th>
                          <th class="center-align">ดูข้อมูล</th>
                      </tr>
                    </thead>

                    <tbody>

                        @foreach ($comps as $comp)
                        <tr>
                            <td class="center-align">
                                {{ $comp->comp_id}}
                            </td>
                            <td class="center-align">
                             <?php   $date_c = DateThaiShort($comp->comp_date); ?>
                                {{ $date_c }}
                            </td>
                            <td class="left-align">
                                {{ $comp->comp_title}}
                            </td>
                            <td class="center-align">
                                 <?php $detail =  $comp->comp_detail; ?>
                                <div class="btn-edit">
                                    <a href="#" class="modal-trigger" data-toggle="modal" data-target="modal1"
                                    onClick="setBillModal('<?php echo   $comp->comp_id. '\',\''.
                                                                        $comp->mem_no. '\',\''.
                                                                        $comp->mem_fname. '\',\''.
                                                                        $comp->mem_lname. '\',\''.
                                                                        $date_c. '\',\''.
                                                                        $comp->comp_title. '\','.'`'.
                                                                        $detail.'`'?>)">
                                            <i class="small material-icons">pageview</i>
                                        </a>
                                    </div>
                                </td>
                        </tr>

                        @endforeach

                        @if(count($comps) == 0)
                               <td></td>
                               <td colspan="2" class="center-align">ไม่พบข้อมูล</td>
                               <td></td>
                        @endif

                    </tbody>
                  </table>



              <br><br>
              <ul class="pagination center">
                {{ $comps->appends(['comp_searchdate' => request()->comp_searchdate, 'per_page' => request()->per_page])->links() }}
                  </ul>
</div>

{{-- ------------------------ modal ---------------------- --}}
<div class="showComp">
    <div id="modal1" class="modal">
            <div class="modal-content">
                <h5>ข้อมูลร้องเรียน</h5>
                <div class="row">
                    <div class="col s12 m3">
                        รายการ : <label><span id="comp_id" ></span></label>
                    </div>
                    <div class="col s12 m9">
                        เลขที่สมาชิก : <label><span id="mem_no"></span> คุณ<span id="mem_fname"></span> <span id="mem_lname"></span></label>
                    </div>
                    {{-- <div class="col s12 m4">
                        <label>คุณ<span id="mem_fname"></span> <span id="mem_lname"></span></label>
                    </div> --}}
                    <div class="col s12 m5">
                        วันที่ร้องเรียน : <label><span id="comp_date"></span></label>
                    </div>
                    <div class="col s12 m12">
                        เรื่องร้องเรียน : <label><span id="comp_title"></span></label>
                    </div>
                    <div class="col s12 m12">
                        รายละเอียด : <label><span id="comp_detail"></span></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/complaintView.js') }}"></script>
@endsection
