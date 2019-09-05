@extends('main')
@section('title','จัดการข้อมูลตำแหน่งในกองทุน')
@section('content')

<div class="container tbfund">
    <div class="row">
    </div>
    <div class="row">
        <div class="col s12 m12 right-align">
            <a href="#creaeposfund" class="waves-effect waves-light btn  modal-trigger"><i class="material-icons left">group_add</i>ตำแหน่งในกองทุน</a>
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
                    @foreach ($pfunds as $pfund)
                    <tr>
                            <td>{{ $pfund->position_fid}}</td>
                            <td>{{ $pfund->position_fname}}</td>
                            <td>
                                <div class="btn-edit">
                                    {{-- <a href='/posfund/{{$pfund->position_fid}}/edit'><i class='small material-icons'>mode_edit</i></a> --}}
                                    <a href="#" class="modal-trigger" data-toggle="modal" data-target="editposfund"
                                    onClick="setBillModal('<?php echo   $pfund->position_fid. '\',\''.
                                                                        $pfund->position_fname;?>')">
                                            <i class="small material-icons">mode_edit</i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="btn-delete">
                                    <a id="delete-btn" href="{{ route('posfund.destroy', $pfund->position_fid) }}"><i class='small material-icons'>delete_forever</i></a>
                                </div>
                            </td>
                    </tr>
                    @endforeach

                    </tbody>
            </table>
            <br><br>
</div>

            <div class="crea-g">
                    <div id="creaeposfund" class="modal">
                            <div class="modal-content frm_cre_per">
                                <form action="posfund" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 m11">
                                            <i class="material-icons prefix">group</i>
                                            <input name="position_fname" type="text" id="icon_prefix" class="validate" maxlength="50" required>
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
                    <div id="editposfund" class="modal">
                        <div class="modal-content frm_cre_per">
                            <form action="posfund/update" method="post">
                                        @method('PATCH')
                                        @csrf
                                <div class="row">
                                    <div class="input-field col s12 m11">
                                        <i class="material-icons prefix">group</i>
                                        <input name="position_fid" type="hidden" id="position_fid" class="validate">
                                        <input name="position_fname" type="text" id="position_fname" class="validate" maxlength="50" autofocus required>
                                        <label for="position_fname">ชื่อตำแหน่ง</label>
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
            <script src="{{ asset('js/posFundManage.js') }}"></script>
@endsection
