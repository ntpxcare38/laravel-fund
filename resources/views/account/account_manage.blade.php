@extends('main')
@section('title','จัดการรายรับ-รายจ่าย')
@section('content')

<?php

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
                    <h5><i class="tiny material-icons">account_balance_wallet</i> จัดการข้อมูลรายรับ-รายจ่าย</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m11 right">
        <form action="search_ac" id="s_account"  method="GET" name="search">
            @csrf
                <div class="input-field col s11 m4">
                        <i class="material-icons prefix">search</i>
                        <input name="per_page" type="hidden" value="{{ request()->per_page }}">
                        <input name="ac_search" type="text" id="ac_search" class="autocomplete" value="{{ request()->ac_search }}">
                        <label for="ac_search">ค้นหาชื่อรายการ</label>
                </div>
                <div class="input-field col s7 m3">
                        <i class="material-icons prefix">date_range</i>
                        <input name="acc_searchdate" type="text" id="icon_prefix" onchange="$('#s_account').submit()" class="datepicker" value="{{ request()->acc_searchdate }}">
                        <label for="icon_prefix">วันที่ทำรายการ</label>
                </div>
                <div class="input-field col s5 m2 center">
                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                </div>
        </form>
                <div class="input-field col s12 m3 right-align">
                    <a href="/ac/create" class="btn waves-effect waves-light btn-black"><i class="material-icons left">playlist_add</i>เพิ่มรายการ</a>
                </div>
            </div>
            <div class="col s3 m1 perPageList left">
                <form role="form" class="form-inline" method="get" action='{{ url('/ac') }}'>
                <label>รายการ
                <select name="per_page" onchange="this.form.submit()" class="form-control input-sm">
                    <option value=""></option>
                    <option value="10" {{ $acs->perPage() == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $acs->perPage() == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $acs->perPage() == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $acs->perPage() == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $acs->perPage() == 100 ? 'selected' : '' }}>100</option>
                </select>
                </label>
            </div>
        </div>


        <table class="highlight responsive-table">
                <thead>

                  <tr>
                      <th class="center">วันที่ทำรายการ</th>
                      <th>ชื่อรายการ</th>
                      <th class="center">หมวด</th>
                      <th class="center">ประเภท</th>
                      <th><div class="columnMoney">รวมเงิน</div></th>
                      <th class="center">ดูข้อมูล</th>
                      <th class="center">แก้ไข</th>
                      <th class="center">ลบ</th>
                  </tr>
                </thead>

                <tbody>

                    @foreach ($acs as $ac)
                    <tr>
                        <td class="center">{{ DateThaiShort($ac->acc_date) }}</td>
                        <td width="25%">{{ $ac->acc_name}}</td>
                        @foreach ($gcs as $gc)
                                    @if($gc->group_acid==$ac->group_acid)
                                        <?php
                                            $gacname = $gc->group_acname;
                                            $gactype = $gc->type_acc;
                                        ?>
                                        <td class="center">
                                            {{$gacname}}
                                        </td>
                                        <td class="center">
                                            @if($gc->type_acc==1)
                                                รายรับ
                                            @elseif($gc->type_acc==2)
                                                รายได้
                                            @elseif($gc->type_acc==3)
                                                <font color="red">รายจ่าย</font>
                                            @elseif($gc->type_acc==4)
                                                <font color="red"> ค่าใช้จ่าย</font>
                                            @endif
                                        </td>
                                    @endif
                            @endforeach
                        <?php
                            $acPrice = 0;
                            $acTotal = 0;

                            $acDate = DateThaiShort($ac->acc_date);
                            $acPrice = number_format($ac->acc_price,2);
                            $acTotal = number_format($ac->acc_total,2);
                            if($ac->acc_file==''){
                                $acc_file = 'javascript:;';
                            }
                            else{
                                $acc_file = 'view/'.$ac->acc_file;
                            }

                        ?>
                        <td><div class="columnMoney">{{ number_format($ac->acc_total, 2) }}</div></td>
                        <td class="center-align">
                            <div class="btn-edit">
                                    <a href="#" class="modal-trigger" data-toggle="modal" data-target="modal1"
                                    onClick="setBillModal('<?php echo
                                                                        $acDate. '\',\''.
                                                                        $ac->acc_name. '\',\''.
                                                                        $gacname. '\',\''.
                                                                        $gactype. '\',\''.
                                                                        $ac->acc_piece. '\',\''.
                                                                        $acPrice. '\',\''.
                                                                        $acTotal. '\',\''.
                                                                        $acc_file;?>')">
                                            <i class="small material-icons">pageview</i>
                                        </a>
                                    </div>

                        </td>
                        <td class="center">
                            <div class="btn-edit">
                                <a href='/ac/{{$ac->acc_id}}/edit'><i class='small material-icons'>mode_edit</i></a>
                            </div>
                        </td>
                        <td class="center">
                            <div class="btn-delete">
                                <a id="delete-btn" href="{{ route('ac.destroy', $ac->acc_id) }}"><i class='small material-icons'>delete_forever</i></a>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                    @if(count($acs) == 0)
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                            <td>ไม่พบข้อมูล</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                    @endif

                </tbody>
        </table>

              <br><br>
                <ul class="pagination center">
                    {{ $acs->appends(['ac_search' => request()->ac_search,'acc_searchdate' => request()->acc_searchdate, 'per_page' => request()->per_page])->links() }}
                </ul>

</div>
<div class="showMem">
    <div id="modal1" class="modal">
            <div class="modal-content">
                <h5>ข้อมูลรายรับ-รายจ่าย</h5>

                <div class="row">
                    <ul>
                        <li>เอกสารแนบ : <a target="blank" id="acc_file" class="btn-floating btn-small waves-effect waves-light #45baaa right"><i class="material-icons left">attach_file</i></a></li>
                        <li>วันที่ทำรายการ : <label><span id="acDate"></span></label></li>
                        <li>ชื่อรายการ : <label><span id="acc_name"></span></label></li>
                        <li>หมวด : <label><span id="gacname"></span></label></li>
                        <li>ประเภท : <label><span id="gactype"></span></label></li>
                        <li>จำนวน : <label class="right"><span id="acc_piece"></span> หน่วย</label></li>
                        <li>ราคา : <label class="right"><span id="acPrice"></span> บาท</label></li>
                        <li>รวมเงิน : <label class="right"><span id="acTotal"></span> บาท</label></li><br>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-action modal-close btn-flat">CLOSE</button>
                </div>
            </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('autocomplete.fetchAc') }}",
                        method:"GET",
                        success:function(data){
                            var memnoArray = data;
                            let amonutArr = []
                            memnoArray.forEach(value => {
                                //const mergeValue = `${value.mem_no} ${value.mem_fname} ${value.mem_lname}`
                                const mergeValueName = `${value.acc_name}`
                                amonutArr[mergeValueName] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: amonutArr,
                                onAutocomplete: function(data) {
                                   $('#s_account').submit();
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
