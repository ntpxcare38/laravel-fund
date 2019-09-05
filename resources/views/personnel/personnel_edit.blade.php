@extends('main')
@section('title','แก้ไขข้อมูลบุคลากร')
@section('content')

<div class="container content-fund">
    <div class="cre-per">
        <div class="row">
            <form name="formPer" action="{{ route('per.update', $per->p_id) }}" id="formPer" onsubmit="return chkFrmPerEdit();" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                    <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input id="imageUpload" name="p_photo" type="file" accept=".png, .jpg, .jpeg">
                                <label for="imageUpload"><i class=" material-icons">camera_alt</i></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('/storage/{{$per->p_photo}}');">
                                </div>
                            </div>
                    </div>
                    <div class="col s12 m2">
                        <div class="row">
                            <div class="col s12 m2">
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="1" @if($per->p_title==1) checked='checked' @endif required>
                                    <span>นาย</span>
                                </label>
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="2" @if($per->p_title==2) checked='checked' @endif required>
                                    <span>นาง</span>
                                </label>
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="3" @if($per->p_title==3) checked='checked' @endif required>
                                    <span>นางสาว</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m10">
                        <div class="input-field col s9 m6">
                            <i class="material-icons prefix">account_box</i>
                            <input name="p_fname" type="text" id="icon_prefix" class="validate" value="{{$per->p_fname}}" onkeyup="javascript:controlchars(this,alpha)" maxlength="40" required>
                            <label for="icon_prefix">ชื่อ</label>
                        </div>
                        <div class="input-field col s9 m5">
                            <input name="p_lname" id="p_lname" type="text" class="validate" value="{{$per->p_lname}}" onkeyup="javascript:controlchars(this,alpha)" maxlength="40" required>
                            <label for="p_lname">นามสกุล</label>
                        </div>
                    </div>
                    <div class="col s12 m11">
                        <div class="input-field col s11 m6">
                            <i class="material-icons prefix">group</i>
                                <select name="position_fid" id="posfSelect">
                                    <option value="0">เลือกตำแหน่งในกองทุน</option>
                                    @foreach ($pfunds as $pfund)
                                        <option value="{{$pfund->position_fid}}" @if($pfund->position_fid==$per->position_fid) selected='selected' @endif>{{$pfund->position_fname}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="input-field col s11 m6">
                            <i class="material-icons prefix">group</i>
                                <select name="position_cid" id="poscSelect">
                                    <option value="0">เลือกตำแหน่งในชุมชน</option>
                                    @foreach ($pcoms as $pcom)
                                        <option value="{{$pcom->position_cid}}" @if($pcom->position_cid==$per->position_cid) selected='selected' @endif>{{$pcom->position_cname}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col s12 m12">
                        <div class="input-field col s10 m5">
                            <i class="material-icons prefix">person</i>
                                <select name="type_pid" id="type_pSelect">
                                    <option value="0">เลือกประเภทผู้ใช้</option>
                                    <option value="1" @if($per->type_pid==1) selected @endif>ผู้ดูแลระบบ</option>
                                    <option value="2" @if($per->type_pid==2) selected @endif>ผู้บริหาร/กรรมการ</option>
                                    <option value="3" @if($per->type_pid==3) selected @endif>เจ้าหน้าที่</option>
                                    <option value="4" @if($per->type_pid==4) selected @endif>พ้นสภาพ</option>

                                </select>
                        </div>
                        <div class="input-field col s8 m3">
                            <i class="material-icons prefix">phone</i>
                            <input name="p_tel" type="tel" id="icon_prefix" class="validate" value="{{$per->p_tel}}" onkeyup="javascript:controlchars(this,number)"  minlength="9" maxlength="10" required>
                            <label for="icon_prefix">เบอร์โทรศัพท์</label>
                        </div>
                    </div>
                    <div class="col s12 m12">
                        <div class="input-field col s7 m5">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password" type="password" id="icon_prefix" class="validate">
                            <label for="icon_prefix">Password</label>
                        </div>
                        <div class="input-field col s5 m4">
                            <input name="p_cpassword" type="password" id="icon_prefix" class="validate">
                            <label for="icon_prefix">Confirm Password</label>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="col s12 m12 center-align">
                        <button class="btn waves-effect waves-light" type="submit" name="action">บันทึก</button>
                        <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light" type="button" name="action">ยกเลิก</button></a>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/person.js') }}"></script>

@endsection
