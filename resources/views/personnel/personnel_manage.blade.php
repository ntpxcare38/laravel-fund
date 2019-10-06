@extends('main')
@section('title','จัดการข้อมูลบุคลากร')
@section('content')
<div class="container tbfund">
        <div class="row">
            <div class="title col s12 m6 left">
                <h5><i class="tiny material-icons">person</i> จัดการข้อมูลบุคลากร</h5>
            </div>
            <div class="input-field col s12 m6 right-align">
                <a href="/pdfper" target="_blank" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>พิมพ์รายชื่อทั้งหมด</a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m11 right">
        <form id="s_personnel" action="search_per" method="GET" name="search">
            @csrf
                <div class="input-field col s12 m4">
                    <i class="material-icons prefix">search</i>
                        <input name="per_page" type="hidden" value="{{ request()->per_page }}">
                        <input name="per_search" type="text" id="per_search" class="autocomplete" value="{{ request()->per_search }}">
                        <label for="per_search">ค้นหาลำดับ ,ชื่อสกุล</label>
                </div>
                <div class="input-field col s12 m2 center">
                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                </div>
        </form>
                <div class="input-field col s12 m6 right-align">
                    <a href="/per/create" class="btn waves-effect waves-light btn-black"><i class="material-icons left">person_add</i>เพิ่มบุคลากร</a>
                </div>
            </div>
            <div class="col s2 m1 perPageList left">
                <form role="form" class="form-inline" method="get" action='{{ url('/per') }}'>
                <label>รายการ
                <select name="per_page" onchange="this.form.submit()" class="form-control input-sm">
                    <option value=""></option>
                    <option value="10" {{ $pers->perPage() == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $pers->perPage() == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $pers->perPage() == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $pers->perPage() == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $pers->perPage() == 100 ? 'selected' : '' }}>100</option>
                </select>
                </label>
            </div>
        </div>

        <table class="highlight responsive-table centered">
                <thead>
                    <tr>
                      <th>ลำดับ</th>
                      <th>ชื่อ-นามสกุล</th>
                      <th>ตำแหน่งในกองทุน</th>
                      <th>ตำแหน่งในชุมชน</th>
                      <th>ประเภทผู้ใช้</th>
                      <th>ดูข้อมูล</th>
                      <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pers as $per)
                    <tr>
                        <td>{{ $per->p_id}}</td>
                        <td>
                            @if($per->p_title==1)
                                นาย{{$per->p_fname}} {{ $per->p_lname}}
                            @elseif($per->p_title==2)
                                นาง{{$per->p_fname}} {{ $per->p_lname}}
                            @elseif($per->p_title==3)
                                นางสาว{{$per->p_fname}} {{ $per->p_lname}}
                            @endif

                        </td>
                        <td>
                            @foreach ($pfunds as $pfund)
                                @if($per->position_fid==$pfund->position_fid)
                                    {{$pfund->position_fname}}
                                    <?php $position_f = $pfund->position_fname; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($pcoms as $pcom)
                                @if($per->position_cid==$pcom->position_cid)
                                    {{$pcom->position_cname}}
                                    <?php $position_c = $pcom->position_cname; ?>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($per->type_pid==1)
                                ผู้ดูและระบบ
                            @elseif($per->type_pid==2)
                                ผู้บริหาร/กรรมการ
                            @elseif($per->type_pid==3)
                                เจ้าหน้าที่
                            @elseif($per->type_pid==4)
                                <font color="red">พ้นสภาพ</font>
                            @endif

                        </td>
                        <td>
                            <div class="btn-edit">
                                    <a href="#" class="modal-trigger" data-toggle="modal" data-target="modal1"
                                    onClick="setBillModal('<?php echo   $per->p_id. '\',\''.
                                                                        $per->p_title. '\',\''.
                                                                        $per->p_fname. '\',\''.
                                                                        $per->p_lname. '\',\''.
                                                                        $per->p_photo. '\',\''.
                                                                        $position_f. '\',\''.
                                                                        $position_c. '\',\''.
                                                                        $per->p_tel. '\',\''.
                                                                        $per->type_pid. '\',\''.
                                                                        $per->p_username;?>')">
                                            <i class="small material-icons">pageview</i>
                                        </a>
                                    </div>

                        </td>
                        <td>
                            <div class="btn-edit">
                                <a href='/per/{{$per->p_id}}/edit'><i class='small material-icons'>mode_edit</i></a>
                            </div>
                            {{-- <div class="btn-edit">
                                <a href='download/{{$per->p_photo}}'><i class='small material-icons'>archive</i></a>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach

                @if(count($pers) == 0)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ไม่พบข้อมูล</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                </tbody>
        </table>
        <br><br>
        <ul class="pagination center">
            {{ $pers->appends(['per_search' => request()->per_search, 'per_page' => request()->per_page])->links() }}
        </ul>
</div>

{{-- ------------------------ modal ---------------------- --}}
<div class="showMem">
        <div id="modal1" class="modal">
                <div class="modal-content">
                    <h5>ข้อมูลบุคลากร</h5>

                    <div class="row">
                        <ul>

                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <div id="imagePreview">
                                    </div>
                                </div>
                            </div>
                                    <div class="col s12 m112 right-align">
                                        <a id="linkImage" class="btn-floating btn-small waves-effect waves-light #45baaa"><i class="material-icons left">file_download</i></a>
                                    </div>
                            <li>ลำดับที่ : <label><span id="p_id" ></span></label></li>
                            <li>ชื่อ : <label><span id="p_title"></span><span id="p_fname"> </span></label></li>
                            <li>นามสกุล : <label><span id="p_lname"></span></label></li>
                            <li>ตำแหน่งในกองทุน : <label><span id="position_f"></span></label></li>
                            <li>ตำแหน่งในชุมชน : <label><span id="position_c"></span></label></li>
                            <li>เบอรโทรศัพท์ : <label><span id="p_tel"></span></label></li>
                            <li>ประเภทผู้ใช้ : <label><span id="type_per"></span></label></li>
                            <li>Username : <label><span id="p_username"></span></label></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="modal-action modal-close btn-flat">CLOSE</button>
                    </div>
                </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/personManage.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('autocomplete.fetchPer') }}",
                        method:"GET",
                        success:function(data){
                            var memnoArray = data;
                            let amonutArr = []
                            memnoArray.forEach(value => {
                                //const mergeValue = `${value.mem_no} ${value.mem_fname} ${value.mem_lname}`
                                const mergeValueId = `${value.p_id}`
                                const mergeValueFname = `${value.p_fname}`
                                const mergeValueLname = `${value.p_lname}`
                                amonutArr[mergeValueId] = null
                                amonutArr[mergeValueFname] = null
                                amonutArr[mergeValueLname] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: amonutArr,
                                onAutocomplete: function(data) {
                                   $('#s_personnel').submit();
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
