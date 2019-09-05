@extends('main')
@section('title','เพิ่มข้อมูลบุคลากร')
@section('content')
<div class="container content-fund">
    <div class="cre-per">
        <div class="row">
            <form name="formPer" action="/per" onsubmit="return chkFrmPer()" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('POST') }}

                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input id="imageUpload" name="p_photo" type="file" accept=".png, .jpg, .jpeg">
                            <label for="imageUpload"><i class=" material-icons">camera_alt</i></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('/storage/avatar/none_profile.jpeg');">
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m2">
                        <div class="row">
                            <div class="col s12 m2">
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="1" @if(old('p_title') == 1) checked @endif required>
                                    <span>นาย</span>
                                </label>
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="2" @if(old('p_title') == 2) checked @endif required>
                                    <span>นาง</span>
                                </label>
                                <label>
                                    <input name="p_title" class="with-gap" type="radio" value="3" @if(old('p_title') == 3) checked @endif required>
                                    <span>นางสาว</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m10">
                        <div class="input-field col s11 m6">
                            <i class="material-icons prefix">account_box</i>
                            <input name="p_fname" type="text" id="icon_prefix" class="validate" onkeyup="javascript:controlchars(this,alpha)" onkeydown="javascript:controlchars(this,alpha)" maxlength="40" value="{{ old('p_fname') }}" required>
                            <label for="icon_prefix">ชื่อ</label>
                        </div>
                        <div class="input-field col s11 m5">
                            <input name="p_lname" id="p_lname" type="text" class="validate" onkeyup="javascript:controlchars(this,alpha)" onkeydown="javascript:controlchars(this,alpha)" maxlength="40" value="{{ old('p_lname') }}" required>
                            <label for="p_lname">นามสกุล</label>
                        </div>
                    </div>
                    <div class="col s12 m11">
                        <div class="input-field col s11 m6">
                            <i class="material-icons prefix">group</i>
                                <select name="position_fid" id="posfSelect">
                                    <option value="0">เลือกตำแหน่งในกองทุน</option>
                                    @foreach ($pfunds as $pfund)
                                        <option value="{{$pfund->position_fid}}" @if(old('position_fid') == $pfund->position_fid) selected @endif>{{$pfund->position_fname}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="input-field col s11 m6">
                            <i class="material-icons prefix">group</i>
                                <select name="position_cid" id="poscSelect">
                                    <option value="0">เลือกตำแหน่งในชุมชน</option>
                                    @foreach ($pcoms as $pcom)
                                        <option value="{{$pcom->position_cid}}" @if(old('position_cid') == $pcom->position_cid) selected @endif>{{$pcom->position_cname}}</option>
                                    @endforeach
                                </select>
                        </div>
                  </div>
                  <div class="col s12 m12">
                    <div class="input-field col s10 m4">
                        <i class="material-icons prefix">person_outline</i>
                        <input name="p_username" type="text" id="username" class="validate" onkeyup="javascript:controlchars(this,usn)" onkeydown="javascript:controlchars(this,usn)" minlength="6"  maxlength="30" value="{{ old('p_username') }}" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s10 m5">
                        <i class="material-icons prefix">person</i>
                            <select name="type_pid" id="type_pSelect">
                                <option value="0">เลือกประเภทผู้ใช้</option>
                                <option value="1" @if(old('type_pid') == 1) selected @endif>ผู้ดูแลระบบ</option>
                                <option value="2" @if(old('type_pid') == 2) selected @endif>ผู้บริหาร/กรรมการ</option>
                                <option value="3" @if(old('type_pid') == 3) selected @endif>เจ้าหน้าที่</option>
                                <option value="4" @if(old('type_pid') == 4) selected @endif>พ้นสภาพ</option>

                            </select>
                    </div>
                    <div class="input-field col s8 m3">
                        <i class="material-icons prefix">phone</i>
                        <input name="p_tel" type="tel" id="icon_prefix" class="validate" onkeyup="javascript:controlchars(this,number)" onkeydown="javascript:controlchars(this,number)" minlength="9" maxlength="10" value="{{ old('p_tel') }}" required>
                        <label for="icon_prefix">เบอร์โทรศัพท์</label>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="input-field col s7 m5">
                        <i class="material-icons prefix">vpn_key</i>
                        <input name="password" type="password" id="icon_prefix" class="validate" required>
                        <label for="icon_prefix">Password</label>
                    </div>
                    <div class="input-field col s5 m4">
                        <input name="p_cpassword" type="password" id="icon_prefix" class="validate" required>
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
