@extends('main')
@section('title','จัดการข้อมูลประเภทสมาชิก')
@section('content')


<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="title col s12 m6 left">
            <h5><i class="tiny material-icons">people_outline</i> จัดการข้อมูลประเภทสมาชิก</h5>
        </div>
        <div class="col s12 m6 right-align">
            <a href="#creattypemem" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">group_add</i>ประเภทสมาชิก</a>
        </div>
    </div>

    <table class="highlight centered responsive-table">
            <thead>
              <tr>
                  <th>ประเภท</th>
                  <th>ชื่อประเภทสมาชิก</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
              </tr>
            </thead>

            <tbody>
            @foreach ($mtypes as $mtype)
            <tr>
                    <td>{{ $mtype->type_mid}}</td>
                    <td>{{ $mtype->type_mname}}</td>
                    <td>
                        <div class="btn-edit">
                            {{-- <a href='/mtype/{{$mtype->type_mid}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                            <a href="#" class="modal-trigger" data-toggle="modal" data-target="editmtype"
                                    onClick="setBillModal('<?php echo   $mtype->type_mid. '\',\''.
                                                                        $mtype->type_mname;?>')">
                                            <i class="small material-icons">mode_edit</i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-delete">
                            <a id="delete-btn" href="{{ route('mtype.destroy', $mtype->type_mid) }}"><i class='small material-icons'>delete_forever</i></a>
                        </div>
                    </td>
            </tr>
            @endforeach

            </tbody>
          </table>
          <br><br>
</div>

        <div class="crea-g">
                <div id="creattypemem" class="modal">
                        <div class="modal-content frm_cre_per">
                            <form action="mtype" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12 m11">
                                        <i class="material-icons prefix">group</i>
                                        <input name="type_mname" type="text" id="icon_prefix" class="validate" maxlength="50" required>
                                        <label for="icon_prefix">ชื่อประเภทสมาชิก</label>
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

            <div class="crea-g">
                <div id="editmtype" class="modal">
                        <div class="modal-content frm_cre_per">
                            <form action="mtype/update" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12 m11">
                                        <i class="material-icons prefix">group</i>
                                        <input name="type_mid" type="hidden" id="type_mid" class="validate">
                                        <input name="type_mname" type="text" id="type_mname" class="validate" maxlength="50" autofocus required>
                                        <label for="type_mname">ชื่อประเภทสมาชิก</label>
                                    </div>
                                    <div class="col s12 m12 center-align">
                                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action">แก้ไข</button>
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
            <script src="{{ asset('js/mtypeManage.js') }}"></script>


@endsection
