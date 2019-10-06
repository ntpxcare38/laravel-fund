@extends('main')
@section('title','จัดการข้อมูลหมู้บ้าน')
@section('content')

<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="title col s12 m6 left">
            <h5><i class="tiny material-icons">home</i> จัดการข้อมูลหมู่บ้าน</h5>
        </div>
        <div class="col s12 m6 right-align">
            <a href="#creattypemem" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">home</i>เพิ่มหมู่บ้าน</a>
        </div>
    </div>

        <table class="highlight centered responsive-table">
            <thead>
              <tr>
                  <th>หมู่</th>
                  <th>ชื่อหมู่บ้าน</th>
                  <th>แก้ไข</th>
              </tr>
            </thead>

            <tbody>
            @foreach ($vils as $vil)
            <tr>
                    <td>{{ $vil->v_id}}</td>
                    <td>{{ $vil->v_name}}</td>
                    <td>
                        <div class="btn-edit">
                            {{-- <a href='/vil/{{$vil->v_id}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                            <a href="#" class="modal-trigger" data-toggle="modal" data-target="editvil"
                                    onClick="setBillModal('<?php echo   $vil->v_id. '\',\''.
                                                                        $vil->v_name;?>')">
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

        <div class="crea-g">
            <div id="creattypemem" class="modal">
                    <div class="modal-content frm_cre_per">
                        <form action="vil" method="post">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m11">
                                    <i class="material-icons prefix">home</i>
                                    <input name="v_name" type="text" id="icon_prefix" class="validate" maxlength="50" required>
                                    <label for="icon_prefix">ชื่อหมู่บ้าน</label>
                                </div>
                                <div class="col s12 m12 center-align">
                                    <button class="btn waves-effect waves-light btn-black" type="submit" name="action" onclick="IsEmpty(event)" >เพิ่ม</button>
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
            <div id="editvil" class="modal">
                    <div class="modal-content frm_cre_per">
                        <form action="vil/update" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m11">
                                    <i class="material-icons prefix">home</i>
                                    <input name="v_id" type="hidden" id="v_id" class="validate">
                                    <input name="v_name" type="text" id="v_name" class="validate" maxlength="50" autofocus required>
                                    <label for="v_name">ชื่อหมู่บ้าน</label>
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
        <script src="{{ asset('js/vilManage.js') }}"></script>


@endsection
