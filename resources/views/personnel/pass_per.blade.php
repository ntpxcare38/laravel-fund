@extends('main')
@section('title','เปลี่ยนรหัสผ่านผู้ใช้')
@section('content')

<div class="container content-fund">
        <div class="show-mem-pass">
            <div class="row">
                <div class="col s12 m12">
                    <h5 class="left">เปลี่ยนรหัสผ่าน</h5>
                </div>
            </div>
            <form name="formPwMem" action="{{ route('pw_per.update',Auth::user()->p_id) }}" onsubmit="return chkPwdMem();" method="post">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="input-field col s12 m7">
                        <input name="old_password" type="password" class="validate form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="{{ old('old_password') }}" required autofocus>
                        <label>Password</label>
                        @if ($errors->has('old_password'))
                        <span><font color="red">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </font></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input name="new_password" type="password" class="validate form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" value="{{ old('new_password') }}" required>
                        <label>New Password</label>
                        @if ($errors->has('new_password'))
                        <span><font color="red">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </font></span>
                        @endif
                    </div>
                    <div class="input-field col s12 m6">
                        <input name="cnew_password" type="password" class="validate" required>
                        <label>Confirm New Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="center-align">
                        <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ยืนยัน</button>
                        <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light btn-black" type="button" name="action">ยกเลิก</button></a>
                    </div>
                </div>
            </form>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/pwdChk.js') }}"></script>

@endsection




