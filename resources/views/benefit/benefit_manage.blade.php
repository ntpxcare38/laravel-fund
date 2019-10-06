@extends('main')
@section('title','จัดการสวัสดิการ')
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
                <div class="title col s6 m6 left">
                        <h5><i class="tiny material-icons">assignment_ind</i> จัดการข้อมูลสวัสดิการ</h5>
                </div>
            <div class="input-field col s6 m6 right-align">
                <a href="/reBenMonth" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์ข้อมูลการจ่ายสวัสดิการ</a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m11 right">
        <form action="search_ben" id="s_benefit" method="GET" name="search">
            @csrf
                <div class="input-field col s11 m4">
                        <i class="material-icons prefix">search</i>
                        <input name="per_page" type="hidden" value="{{ request()->per_page }}">
                        <input name="ben_search" type="text" id="ben_search" class="autocomplete" value="{{ request()->ben_search }}">
                        <label for="ben_search">ค้นหารายการ, เลขสมาชิก</label>
                </div>
                <div class="input-field col s7 m3">
                        <i class="material-icons prefix">date_range</i>
                        <input name="ben_searchdate" type="text" id="icon_prefix" onchange="$('#s_benefit').submit()" class="datepicker" value="{{ request()->ben_searchdate }}">
                        <label for="icon_prefix">ตั้งแต่วันที่</label>
                </div>
                <div class="input-field col s5 m2 center">
                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                </div>
        </form>
                <div class="input-field col s12 m3 right-align">
                    <a href="/ben/create" class="btn waves-effect waves-light btn-black"><i class="material-icons left">playlist_add</i>เพิ่มรายการ</a>
                </div>
            </div>
            <div class="col s2 m1 perPageList left">
                <form role="form" class="form-inline" method="get" action='{{ url('/ben') }}'>
                <label>รายการ
                <select name="per_page" onchange="this.form.submit()" class="form-control input-sm">
                    <option value=""></option>
                    <option value="10" {{ $bens->perPage() == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $bens->perPage() == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $bens->perPage() == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $bens->perPage() == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $bens->perPage() == 100 ? 'selected' : '' }}>100</option>
                </select>
                </label>
            </div>
        </div>

        <table class="highlight responsive-table">
                <thead>

                  <tr>
                      <th class="center">รายการ</th>
                      <th>เลขสมาชิก</th>
                      <th>ชื่อสมาชิก</th>
                      <th>วันที่ทำรายการ</th>
                      <th>สวัสดิการ</th>
                      <th>หมายเหตุ</th>
                      <th class="right-align">จำนวนเงิน</th>
                      <th class="center-align">แก้ไข</th>
                      <th class="center-align">ลบ</th>
                  </tr>
                </thead>

                <tbody>

                    @foreach ($bens as $ben)
                    <tr>
                        <td class="center">{{ $ben->benefit_id}}</td>
                        <td>{{ $ben->mem_no}}</td>
                        <td>{{ $ben->mem_fname}} {{ $ben->mem_lname}}</td>
                        <td>{{ DateThaiShort($ben->benefit_date)}}</td>
                        <td>
                        @foreach ($btypes as $btype)
                            @if($ben->type_bid==$btype->type_bid)
                                {{ $btype->type_bname }}
                            @endif
                        @endforeach
                        </td>
                        <td>
                            @if($ben->benefit_annotation=='')
                                {{"-"}}
                            @else
                                {{ $ben->benefit_annotation}}
                            @endif
                        </td>
                        <td class="right-align">{{ number_format($ben->benefit_price, 2) }}</td>
                        <td class="center-align">
                            <div class="btn-edit">
                                <a href='/ben/{{$ben->benefit_id}}/edit'><i class='small material-icons'>mode_edit</i></a>
                            </div>
                        </td>
                        <td class="center-align">
                            <div class="btn-delete">
                                <a id="delete-btn" href="{{ route('ben.destroy', $ben->benefit_id) }}"><i class='small material-icons'>delete_forever</i></a>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                    @if(count($bens) == 0)
                           <td></td>
                           <td></td>
                           <td></td>
                            <td>ไม่พบข้อมูล</td>
                           <td></td>
                           <td></td>
                           <td></td>
                    @endif

                </tbody>
              </table>

            <br><br>
            <ul class="pagination center">
                {{ $bens->appends(['ben_search' => request()->ben_search,'ben_searchdate' => request()->ben_searchdate, 'per_page' => request()->per_page])->links() }}
            </ul>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/benefitManage.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('autocomplete.fetchBen') }}",
                        method:"GET",
                        success:function(data){
                            var memnoArray = data;
                            let amonutArr = []
                            memnoArray.forEach(value => {
                                //const mergeValue = `${value.mem_no} ${value.mem_fname} ${value.mem_lname}`
                                const mergeValueId = `${value.benefit_id}`
                                const mergeValueMemNo = `${value.mem_no}`
                                const mergeValueMemFname = `${value.mem_fname}`
                                const mergeValueMemLname = `${value.mem_lname}`
                                amonutArr[mergeValueId] = null
                                amonutArr[mergeValueMemNo] = null
                                amonutArr[mergeValueMemFname] = null
                                amonutArr[mergeValueMemLname] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: amonutArr,
                                onAutocomplete: function(data) {
                                   $('#s_benefit').submit();
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
