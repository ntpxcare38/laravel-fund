@extends('main')
@section('title','จัดการข้อมูลตำแหน่งในชุมชน')
@section('content')

<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="title col s12 m6 left">
            <h5><i class="tiny material-icons">person_outline</i> จัดการข้อมูลตำแหน่งในชุมชน</h5>
        </div>
        <div class="col s12 m6 right-align">
            <a href="#creatposcom" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">group_add</i>ตำแหน่งในชุมชน</a>
        </div>
    </div>
            <table class="highlight centered responsive-table">
                    <thead>
                      <tr>
                          <th>ตำแหน่ง</th>
                          <th>ชื่อตำแหน่ง</th>
                          <th>แก้ไข</th>
                          <th>ลบ</th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach ($pcoms as $pcom)
                    <tr>
                            <td>{{ $pcom->position_cid}}</td>
                            <td>{{ $pcom->position_cname}}</td>
                            <td>
                            <div class="btn-edit">
                                {{-- <a href='/poscom/{{$pcom->position_cid}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                                <a href="#" class="modal-trigger" data-toggle="modal" data-target="editposcom"
                                    onClick="setBillModal('<?php echo   $pcom->position_cid. '\',\''.
                                                                        $pcom->position_cname;?>')">
                                            <i class="small material-icons">mode_edit</i>
                                    </a>
                            </div>
                            </td>
                            <td>
                                <div class="btn-delete">
                                        <a id="delete-btn" href="{{ route('poscom.destroy', $pcom->position_cid) }}"><i class='small material-icons'>delete_forever</i></a>
                                </div>
                            </td>
                    </tr>
                    @endforeach

                    </tbody>
            </table>
            <br><br>
</div>
                <div class="crea-g">
                        <div id="creatposcom" class="modal">
                                <div class="modal-content frm_cre_per">
                                    <form action="poscom" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12 m11">
                                                <i class="material-icons prefix">group</i>
                                                <input name="position_cname" type="text" id="icon_prefix" class="validate" maxlength="50" required>
                                                <label for="icon_prefix">ชื่อตำแหน่ง</label>
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
                        <div id="editposcom" class="modal">
                            <div class="modal-content frm_cre_per">
                                <form action="poscom/update" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 m11">
                                            <i class="material-icons prefix">group</i>
                                            <input name="position_cid" type="hidden" id="position_cid" class="validate">
                                            <input name="position_cname" type="text" id="position_cname" class="validate" maxlength="50" autofocus required>
                                            <label for="position_cname">ชื่อตำแหน่ง</label>
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
                <script src="{{ asset('js/posComManage.js') }}"></script>
@endsection
