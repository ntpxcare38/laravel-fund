@extends('main')
@section('title','จัดการข้อมูลประเภทสวัสดิการ')
@section('content')

<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="col s12 m12 right-align">
            <a href="#createbentype" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">assignment_ind</i>เพิ่มสวัสดิการ</a>
        </div>
    </div>
            <table class="highlight centered responsive-table">
                    <thead>
                      <tr>
                          <th>ลำดับ</th>
                          <th>ชื่อสวัสดิการ</th>
                          <th>แก้ไข</th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach ($btypes as $btype)
                    <tr>
                            <td>{{ $btype->type_bid}}</td>
                            <td>{{ $btype->type_bname}}</td>
                            <td>
                            <div class="btn-edit">
                                {{-- <a href='/poscom/{{$pcom->position_cid}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                                <a href="#" class="modal-trigger" data-toggle="modal" data-target="editbtype"
                                    onClick="setBillModal('<?php echo   $btype->type_bid. '\',\''.
                                                                        $btype->type_bname;?>')">
                                            <i class="small material-icons">mode_edit</i>
                                    </a>
                            </div>
                            </td>
                    </tr>
                    @endforeach

                    </tbody>
            </table>
            <br><br>
</div>
                <div class="creb-t">
                        <div id="createbentype" class="modal">
                                <div class="modal-content frm_cre_per">
                                    <form action="btype" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12 m11">
                                                <i class="material-icons prefix">assignment_ind</i>
                                                <input name="type_bname" type="text" id="icon_prefix" class="validate" required>
                                                <label for="icon_prefix">ชื่อสวัสดิการ</label>
                                            </div>
                                            <div class="col s12 m12 center-align">
                                                <button class="btn waves-effect waves-light btn-black" type="submit" name="action">เพิ่ม</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="modal-action modal-close btn-flat">CLOSE</button>
                                </div>
                        </div>
                </div>
                <div class="creb-t">
                        <div id="editbtype" class="modal">
                            <div class="modal-content frm_cre_per">
                                <form action="btype/update" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 m11">
                                            <i class="material-icons prefix">assignment_ind</i>
                                            <input name="type_bid" type="hidden" id="type_bid" class="validate">
                                            <input name="type_bname" type="text" id="type_bname" class="validate" autofocus required>
                                            <label for="type_bname">ชื่อสวัสดิการ</label>
                                        </div>
                                        <div class="col s12 m12 center-align">
                                                <button class="btn waves-effect waves-light" type="submit" name="action" >แก้ไข</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="modal-action modal-close btn-flat">CLOSE</button>
                            </div>
                        </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script src="{{ asset('js/benTypeManage.js') }}"></script>
@endsection
