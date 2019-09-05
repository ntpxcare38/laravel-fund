@extends('main')
@section('title','จัดการหมวดรายรับ-รายจ่าย')
@section('content')



<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="col s12 m12 right-align">
            <a href="#creatgroup" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">playlist_add</i>หมวด</a>
        </div>
    </div>

    <table class="highlight centered responsive-table">
            <thead>
              <tr>
                  <th>ลำดับ</th>
                  <th class="left">ชื่อหมวด</th>
                  <th>ประเภท</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
              </tr>
            </thead>

            <tbody>
            @foreach ($gcs as $gc)
            <tr>
                    <td>{{ $gc->group_acid}}</td>
                    <td class="left">{{ $gc->group_acname}}</td>
                    <td>
                            @if($gc->type_acc==1) <?php echo"รายรับ"; ?> @endif
                            @if($gc->type_acc==2) <?php echo"รายได้"; ?> @endif
                            @if($gc->type_acc==3) <?php echo"รายจ่าย"; ?> @endif
                            @if($gc->type_acc==4) <?php echo"ค่าใช้จ่าย"; ?> @endif
                    </td>
                    <td>
                        <div class="btn-edit">
                            {{-- <a href='/gc/{{$gc->group_acid}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                            <a href="#" class="modal-trigger" data-toggle="modal" data-target="editgac"
                                    onClick="setBillModal('<?php echo   $gc->group_acid. '\',\''.
                                                                        $gc->group_acname. '\',\''.
                                                                        $gc->type_acc;?>')">
                                            <i class="small material-icons">mode_edit</i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-delete">
                            <a id="delete-btn" href="{{ route('gc.destroy', $gc->group_acid) }}"><i class='small material-icons'>delete_forever</i></a>
                        </div>
                    </td>
            </tr>
            @endforeach

            </tbody>
    </table>
    <br><br>
</div>

    <div class="crea-g">
        <div id="creatgroup" class="modal">
                <div class="modal-content frm_cre_per">
                    <form action="/gc" method="post">
                        @csrf
                        <div class="row">
                                <div class="input-field col s11 m11">
                                        <i class="material-icons prefix">dehaze</i>
                                        <input name="group_acname" type="text" id="icon_prefix" class="validate" required>
                                        <label for="icon_prefix">ชื่อหมวด</label>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col s12 m2">
                                </div>
                            <div class="col s12 m4">
                                <label>
                                    <input name="type_acc" class="with-gap" type="radio" value="1" required>
                                    <span>รายรับ</span>
                                </label>
                            </div>
                            <div class="col s12 m6">
                                <label>
                                    <input name="type_acc" class="with-gap" type="radio" value="2" required>
                                    <span>รายได้</span>
                                </label>
                            </div>
                            <div class="col s12 m2">
                                </div>
                            <div class="col s12 m4">
                                <label>
                                    <input name="type_acc" class="with-gap" type="radio" value="3" required>
                                    <span>รายจ่าย</span>
                                </label>
                            </div>
                            <div class="col s12 m6">
                                <label>
                                    <input name="type_acc" class="with-gap" type="radio" value="4" required>
                                    <span>ค่าใช้จ่าย</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                                <div class="center-align">
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
            <div id="editgac" class="modal">
                    <div class="modal-content frm_cre_per">
                        <form action="gc/update" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                    <div class="input-field col s11 m11">
                                            <i class="material-icons prefix">dehaze</i>
                                            <input name="group_acid" type="hidden" id="group_acid" class="validate">
                                            <input name="group_acname" type="text" id="group_acname" class="validate" autofocus required>
                                            <label for="group_acname">ชื่อหมวด</label>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col s12 m2">
                                    </div>
                                <div class="col s12 m4">
                                    <label>
                                        <input name="type_acc" class="with-gap" type="radio" id="type_acc1" value="1" required>
                                        <span>รายรับ</span>
                                    </label>
                                </div>
                                <div class="col s12 m6">
                                    <label>
                                        <input name="type_acc" class="with-gap" type="radio" id="type_acc2" value="2" required>
                                        <span>รายได้</span>
                                    </label>
                                </div>
                                <div class="col s12 m2">
                                    </div>
                                <div class="col s12 m4">
                                    <label>
                                        <input name="type_acc" class="with-gap" type="radio" id="type_acc3" value="3" required>
                                        <span>รายจ่าย</span>
                                    </label>
                                </div>
                                <div class="col s12 m6">
                                    <label>
                                        <input name="type_acc" class="with-gap" type="radio" id="type_acc4" value="4" required>
                                        <span>ค่าใช้จ่าย</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                                    <div class="center-align">
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
        <script src="{{ asset('js/gacManage.js') }}"></script>
@endsection

